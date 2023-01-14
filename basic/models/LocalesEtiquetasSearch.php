<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LocalesEtiquetas;

/**
 * LocalesEtiquetasSearch represents the model behind the search form of `app\models\LocalesEtiquetas`.
 */
class LocalesEtiquetasSearch extends LocalesEtiquetas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'local_id', 'etiqueta_id'], 'integer'],
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
        $query = LocalesEtiquetas::find();

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
            'etiqueta_id' => $this->etiqueta_id,
        ]);

        return $dataProvider;
    }
}
