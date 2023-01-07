<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hostelero;

/**
 * HostelerosSearch represents the model behind the search form of `app\models\Hostelero`.
 */
class HostelerosSearch extends Hostelero
{
	public $nombre;
	public $apellidos;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id'], 'integer'],
            [['nif_cif', 'razon_social', 'telefono_comercio', 'telefono_contacto', 'url', 'fecha_alta', 'nombre', 'apellidos'], 'safe'],
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
        $query = Hostelero::find();

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
            'usuario_id' => $this->usuario_id,
            'fecha_alta' => $this->fecha_alta,
        ]);

        $query->andFilterWhere(['like', 'nif_cif', $this->nif_cif])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'telefono_comercio', $this->telefono_comercio])
            ->andFilterWhere(['like', 'telefono_contacto', $this->telefono_contacto])
            ->andFilterWhere(['like', 'url', $this->url]);

		$query->andFilterWhere(['like','usuarios.nombre', $this->nombre]);
		$query->andFilterWhere(['like','usuarios.apellidos', $this->apellidos]);
		$query->joinWith('usuario');

        return $dataProvider;
    }
}
