<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Asistente;

/**
 * AsistenteSearch represents the model behind the search form of `app\models\Asistente`.
 */
class AsistenteSearch extends Asistente
{
    public $texto;

    public $fecha_desde;
    public $fecha_hasta;

    public $NumParticipantes;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'local_id', 'convocatoria_id', 'usuario_id'], 'integer'],
            [['fecha_alta','titulo','nombre','apellidos','fecha_alta','texto','fecha_desde','fecha_hasta','NumParticipantes'], 'safe'],
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
        $query = Asistente::find();
        $query->joinWith(['local']);
        $query->andFilterWhere(['=', 'titulo', $this->titulo]);
        $query->joinWith(['usuario']);
        $query->andFilterWhere(['=', 'nombre', $this->nombre]);
        $query->joinWith(['usuario']);
        $query->andFilterWhere(['=', 'apellidos', $this->apellidos]);
        $query->joinWith(['convocatoria con']);
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['id','usuario_id', 'fecha_desde','fecha_hasta','titulo','nombre','apellidos','texto']]
        ]);
        $sort=$dataProvider->sort;

        $sort->attributes['convocatoria.fecha_desde'] = [
            'asc' => ['con.fecha_desde' => SORT_ASC],
            'desc' => ['con.fecha_desde' => SORT_DESC],
        ];
        $sort->attributes['convocatoria.fecha_hasta'] = [
            'asc' => ['con.fecha_hasta' => SORT_ASC],
            'desc' => ['con.fecha_hasta' => SORT_DESC],
        ];
        $sort->attributes['convocatoria.texto'] = [
            'asc' => ['con.texto' => SORT_ASC],
            'desc' => ['con.texto' => SORT_DESC],
        ];
        /*$sort->attributes['convocatoria.NumParticipantes']= [
			'asc' => ['COUNT(*)' => SORT_ASC],
			'desc' => ['COUNT(*)' => SORT_DESC],
		];*/

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
            'convocatoria_id' => $this->convocatoria_id,
            'usuario_id' => $this->usuario_id,
            'fecha_alta' => $this->fecha_alta,
        ]);  $query->andFilterWhere(['like', 'titulo', $this->titulo]); $query->andFilterWhere(['like', 'nombre', $this->nombre]); $query->andFilterWhere(['like', 'apellidos', $this->apellidos]);

        $query->andFilterWhere(['like', 'con.texto', $this->texto]);
        



        return $dataProvider;
    }
}
