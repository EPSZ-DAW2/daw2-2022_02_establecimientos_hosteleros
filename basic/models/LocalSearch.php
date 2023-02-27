<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Local;
use app\models\LocalesEtiquetas;

use Yii;

/**
 * LocalSearch represents the model behind the search form of `app\models\Local`.
 */
class LocalSearch extends Local
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'zona_id', 'categoria_id', 'sumaValores', 'totalVotos', 'hostelero_id', 'prioridad', 'visible', 'terminado', 'num_denuncias', 'bloqueado', 'cerrado_comentar', 'cerrado_quedar', 'crea_usuario_id', 'modi_usuario_id', 'etiqueta_id'], 'integer'],
            [['titulo', 'descripcion', 'lugar', 'url', 'imagen_id', 'fecha_terminacion', 'fecha_denuncia1', 'fecha_bloqueo', 'notas_bloqueo', 'crea_fecha', 'modi_fecha', 'notas_admin'], 'safe'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        
        $query = Local::find();
        $query->joinWith('localesEtiquetas');
        //LocalesEtiquetasSearch::search();
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        
        $this->load($params);
        
        $query->andFilterWhere(['=', LocalesEtiquetas::tableName().'.etiqueta_id', $this->etiqueta_id]);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'zona_id' => $this->zona_id,
            'categoria_id' => $this->categoria_id,
            'sumaValores' => $this->sumaValores,
            'totalVotos' => $this->totalVotos,
            'hostelero_id' => $this->hostelero_id,
            'prioridad' => $this->prioridad,
            'visible' => $this->visible,
            'terminado' => $this->terminado,
            'fecha_terminacion' => $this->fecha_terminacion,
            'num_denuncias' => $this->num_denuncias,
            'fecha_denuncia1' => $this->fecha_denuncia1,
            'bloqueado' => $this->bloqueado,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'cerrado_comentar' => $this->cerrado_comentar,
            'cerrado_quedar' => $this->cerrado_quedar,
            'crea_usuario_id' => $this->crea_usuario_id,
            'crea_fecha' => $this->crea_fecha,
            'modi_usuario_id' => $this->modi_usuario_id,
            'modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'lugar', $this->lugar])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'imagen_id', $this->imagen_id])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo])
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo]);

        //$query->andFilterWhere(['like', 'id', $this->id])->andFilterWhere(['like', ])
        return $dataProvider;
    }
}
