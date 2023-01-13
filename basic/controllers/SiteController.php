<?php

namespace app\controllers;

use app\models\Configuracion;
use app\models\Usuario;
use Yii;
use yii\debug\models\search\Log;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		$error="";

		if ($model->load(Yii::$app->request->post())) {

			//Variables de configuracion
			$numVeces=Configuracion::getValorConfiguracion('numero_intentos_usuario');
			$minutos=Configuracion::getValorConfiguracion('tiempo_desbloqueo_usuario');

			//Comprobar si el usuario está bloqueado y ha trascurrido el tiempo necesario para el desbloqueo
			$usuarioAcceso=Usuario::find()->where(['email'=>$model->username])->one();
			//Se comprueba si existe un usuario
			if(isset($usuarioAcceso)) {

				//Si el usuario no está confirmado no puede acceder
				if($usuarioAcceso->confirmado==0){
					$error='Tu cuenta aún no está confirmada, si tarda mucho contacta con un administrador';
					Yii::error('Intento de inicio de sesión de la cuenta no confirmada con email: '.$usuarioAcceso->email);
					return $this->render('login', [
						'model' => $model,
						'error'=>$error,
					]);
				}

				//Si la fecha de bloqueo no es nula
				if($usuarioAcceso->fecha_bloqueo!=null){
					$tiempo = date_diff(date_create(date("Y-m-d H:i:s")), date_create($usuarioAcceso->fecha_bloqueo));	//Diferencia de fechas

					//Si los minutos de diferencia son mayores que x y el usuario esta bloqueado
					if ($tiempo->i >= $minutos && $usuarioAcceso->bloqueado == 1) {
						Yii::$app->session->set('veces', 0);		//Veces en sesion a 0
						$usuarioAcceso->updateFechaBloqueo('');		//Fecha de bloqueo null
						$usuarioAcceso->bloquear(0);		//bloqueado = 0
						$usuarioAcceso->resetNumAccesos();		//Numero de accesos = 0
					}
				}

				//Si el usuario no está bloqueado y las veces en sesión son válidas
				if($usuarioAcceso->bloqueado==0 && $usuarioAcceso->num_accesos<$numVeces && Yii::$app->session->get('veces')<$numVeces-1){
					//Si el login es correcto
					if($model->login()){
						$usuario=Usuario::findOne(Yii::$app->user->identity->id);
						$usuario->updateUltimaConexion();
						$usuario->resetNumAccesos();						//Numero de accesos = 0
						$usuarioAcceso->updateFechaBloqueo('');		//Fecha de bloqueo null
						Yii::$app->session->set('veces',0);

						//IMPORTANTE - Se cambia el homeURL dependiendo si el usuario es admin o no
						if(Usuario::esRolAdmin($usuario->id))
							Yii::$app->homeUrl=array('usuarios/index');
						else
							Yii::$app->homeUrl=array('local/index');

						return $this->goHome();
					}else{	//Si hay un fallo en login
						Yii::$app->session->set('veces',Yii::$app->session->get('veces')+1);
						Yii::error('Intento de inicio de sesión fallido');
						if(Yii::$app->session->get('veces')>$numVeces)
							$error = "Te quedan 0 intentos.";
						else
							$error = "Te quedan ".($numVeces-Yii::$app->session->get('veces'))." intentos.";

						//Se incrementa en 1 el número de accesos
						$usuarioAcceso->incrementNumAccesos();

						//Si es la primera vez que el usuario falla en acceso se guarda la fecha
						if($usuarioAcceso->num_accesos==1)
							$usuarioAcceso->updateFechaBloqueo(date("Y-m-d H:i:s"));

					}
				}else{
					Yii::error('Intento de inicio de sesión fallido, superado número máximo de intentos.');
					$usuarioAcceso->bloquear(1);
					$error="Has superado el número máximo de intentos.";
				}

			}else{	//Si el usuario no se encuentra en la base de datos

				Yii::$app->session->set('veces',Yii::$app->session->get('veces')+1);
				if(Yii::$app->session->get('veces')>$numVeces)
					$error = "Te quedan 0 intentos.";
				else
					$error = "Te quedan ".($numVeces-Yii::$app->session->get('veces'))." intentos.";

				if(Yii::$app->session->get('veces')>$numVeces-1){
					$error="Has superado el número máximo de intentos.";
					Yii::error('Intento de inicio de sesión fallido, superado número máximo de intentos en sesión.');
				}
			}
		}

		return $this->render('login', [
			'model' => $model,
			'error'=>$error,
		]);
	}

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
		//Se cambia el layout y homeUrl
		Yii::$app->layout='publica';
		Yii::$app->homeUrl=array('local/index');

        Yii::$app->user->logout();

        return $this->goHome();
    }

	/**
	 * Registro action.
	 *
	 * @return Response|string
	 */
	public function actionRegistro()
	{
		//Si el usuario está logeado no se puede acceder al registro
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new Usuario();

		//Se cargan los datos por post en el modelo
		if ($model->load(Yii::$app->request->post())) {
			//Se crean campos del modelo de importancia
			$model->fecha_registro=date("Y-m-d H:i:s");
			$model->confirmado=0;
			$model->password=hash("sha1", $model->password);	//Contraseña cifrada por sha1

			//Se valida el modelo
			if($model->validate()){
				//Si se valida correctamente se guarda
				if($model->save()){
					return $this->redirect(['login']);		//Se redirige al login
				}else{
					//Si hay error se pone la password a null y se vuelve al registro
					$model->password=null;
					return $this->render('registro', [
						'model' => $model,
					]);
				}
			}else{
				//Si hay error se pone la password a null y se vuelve al registro
				$model->password=null;
				return $this->render('registro', [
					'model' => $model,
				]);
			}

		}else{
			//Si hay error se vuelve al registro
			return $this->render('registro', [
				'model' => $model,
			]);
		}
	}

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
