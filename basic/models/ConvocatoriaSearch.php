<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Convocatoria;

/**
 * ConvocatoriaSearch represents the model behind the search form of `app\models\Convocatoria`.
 */
class ConvocatoriaSearch extends Convocatoria
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'local_id', 'num_denuncias', 'bloqueada', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['localNombre','texto', 'fecha_desde', 'fecha_hasta', 'fecha_denuncia1', 'fecha_bloqueo', 'notas_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
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
        $query = Convocatoria::find();
        $query->joinWith(['local']);
        $query->andFilterWhere(['=', 'titulo', $this->localNombre]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'local_id' => $this->local_id,
            //'fecha_desde' => $this->fecha_desde,
           //'fecha_hasta' => $this->fecha_hasta,
            'num_denuncias' => $this->num_denuncias,
            'fecha_denuncia1' => $this->fecha_denuncia1,
            'bloqueada' => $this->bloqueada,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'crea_usuario_id' => $this->crea_usuario_id,
            'crea_fecha' => $this->crea_fecha,
            'modi_usuario_id' => $this->modi_usuario_id,
            'modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo]);
            $query->andFilterWhere(['like', 'titulo', $this->localNombre]);

            //filtros para que sean rangos y no un = 
            $query->andFilterWhere(['>', 'fecha_desde', $this->fecha_desde]);
            $query->andFilterWhere(['<', 'fecha_hasta', $this->fecha_hasta]);
        
        return $dataProvider;
    }
}
