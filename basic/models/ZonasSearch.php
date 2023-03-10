<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Zonas;

/**
 * ZonasSearch represents the model behind the search form of `app\models\Zonas`.
 */
class ZonasSearch extends Zonas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'zona_id'], 'integer'],
            [['clase_zona_id', 'nombre', 'padre_Nombre'], 'safe'],
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
        $query = Zonas::find();

        $query->joinWith(['padre','hijos']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => ['attributes' => ['id','nombre','padre.nombre']]
        ]);

        $sort = $dataProvider->sort;

        $sort->attributes['padre_Nombre'] = [
            'asc' => ['padre.Nombre' => SORT_ASC],
            'desc' => ['padre.Nombre' => SORT_DESC],
            'default' => SORT_DESC,
            'label' => 'Nombre del Padre',
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'zona_id' => $this->zona_id,
            //'zonas.clase_zona_id' => $this->clase_zona_id,
        ]);

        $query->andFilterWhere(['like', 'zonas.clase_zona_id', $this->clase_zona_id])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

            $query->andFilterWhere(['like', 'tipo_zona', $this->tipo_zona]);
            $query->andFilterWhere(['like', 'padre.nombre', $this->padre_Nombre]);

        return $dataProvider;
    }
}
