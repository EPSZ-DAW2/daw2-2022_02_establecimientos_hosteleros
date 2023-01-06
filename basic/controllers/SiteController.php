<?php

namespace app\controllers;

use app\models\Usuario;
use Yii;
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

			//Comprobar si el usuario esta bloqueado y ha trascurrido el tiempo necesario para el desbloqueo
			$usuarioAcceso=Usuario::find()->where(['email'=>$model->username])->one();
			//Se comprueba si existe un usuario
			if(isset($usuarioAcceso)) {
				//Si la fecha de bloqueo no es nula
				if($usuarioAcceso->fecha_bloqueo!=null){
					$tiempo = date_diff(date_create(date("Y-m-d H:i:s")), date_create($usuarioAcceso->fecha_bloqueo));	//Diferencia de fechas

					//Si los minutos de diferencia son mayores que x y el usuario esta bloqueado
					if ($tiempo->i >= Yii::$app->params['tiempoMinutos'] && $usuarioAcceso->bloqueado == 1) {
						Yii::$app->session->set('veces', 0);		//Veces en sesion a 0
						$usuarioAcceso->updateFechaBloqueo('');		//Fecha de bloqueo null
						$usuarioAcceso->bloquear(0);		//bloqueado = 0
						$usuarioAcceso->resetNumAccesos();		//Numero de accesos = 0
					}
				}

				//Si el usuario no esta bloqueado y las veces en sesión son válidas
				if($usuarioAcceso->bloqueado==0 && Yii::$app->session->get('veces')<Yii::$app->params['intentos']-1){
					//Si el login es correcto
					if($model->login()){
						$usuario=Usuario::findOne(Yii::$app->user->identity->id);
						$usuario->updateUltimaConexion();
						$usuario->resetNumAccesos();
						Yii::$app->session->set('veces',0);
						return $this->goBack();
					}else{	//Si hay un fallo en login
						Yii::$app->session->set('veces',Yii::$app->session->get('veces')+1);

						if(Yii::$app->session->get('veces')>Yii::$app->params['intentos'])
							$error = "Te quedan 0 intentos.";
						else
							$error = "Te quedan ".(Yii::$app->params['intentos']-Yii::$app->session->get('veces'))." intentos.";

						//Se incrementa en 1 el número de accesos
						$usuarioAcceso->incrementNumAccesos();

						//Si es la primera vez que el usuario falla en acceso se guarda la fecha
						if($usuarioAcceso->num_accesos==1)
							$usuarioAcceso->updateFechaBloqueo(date("Y-m-d H:i:s"));

					}
				}else{
					$usuarioAcceso->bloquear(1);
					$error="Has superado el número máximo de intentos.";
				}

			}else{	//Si el usuario no se encuentra en la base de datos

				Yii::$app->session->set('veces',Yii::$app->session->get('veces')+1);
				if(Yii::$app->session->get('veces')>Yii::$app->params['intentos'])
					$error = "Te quedan 0 intentos.";
				else
					$error = "Te quedan ".(Yii::$app->params['intentos']-Yii::$app->session->get('veces'))." intentos.";

				if(Yii::$app->session->get('veces')>Yii::$app->params['intentos']-1){
					$error="Has superado el número máximo de intentos.";
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
