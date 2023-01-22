<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuarioaviso;

/**
 * UsuarioavisoSearch represents the model behind the search form of `app\models\Usuarioaviso`.
 */
class UsuarioavisoSearch extends Usuarioaviso
{
    public $nombreAviso;
    public $nickDestino;
    public $nickOrigen;
    public $nombreLocal;
    public $nombreLocalInv;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'destino_usuario_id', 'origen_usuario_id', 'local_id', 'comentario_id'], 'integer'],
            [['fecha_aviso', 'clase_aviso_id', 'nombreAviso', 'texto', 'fecha_lectura', 'fecha_aceptado','nickOrigen','nickDestino','nombreLocal'], 'safe'],
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
        $query = Usuarioaviso::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //añadir búsquedas
        $sort= $dataProvider->sort;
        
        $sort->attributes['nombreAviso']= [
			'asc' => ['clase_aviso_id' => SORT_ASC],
			'desc' => ['clase_aviso_id' => SORT_DESC],
		];
        $sort->attributes['nickOrigen']= [
            'asc' => ['origen_usuario_id' => SORT_ASC],
            'desc' => ['origen_usuario_id' => SORT_DESC],
        ];
        $sort->attributes['nickDestino']= [
            'asc' => ['destino_usuario_id' => SORT_ASC],
            'desc' => ['destino_usuario_id' => SORT_DESC],
        ];
        $sort->attributes['nombreLocal']= [
            'asc' => ['local_id' => SORT_ASC],
            'desc' => ['local_id' => SORT_DESC],
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
            'fecha_aviso' => $this->fecha_aviso,
            'destino_usuario_id' => $this->destino_usuario_id,
            'origen_usuario_id' => $this->origen_usuario_id,
            'clase_aviso_id' => $this->clase_aviso_id,
            'local_id' => $this->local_id,
            'comentario_id' => $this->comentario_id,
            'fecha_lectura' => $this->fecha_lectura,
            'fecha_aceptado' => $this->fecha_aceptado,
        ]);

        $query->andFilterWhere(['like', 'clase_aviso_id', $this->clase_aviso_id])
            ->andFilterWhere(['like', 'texto', $this->texto]);
        /*if (!empty($this->nickDestino)) {
            $query->nickDestino( $this->nickDestino, 'usud');
        }
        if (!empty($this->nickOrigen)) {
            $query->nickOrigen( $this->nickOrigen, 'usuo');
        }
        if (($sort->getAttributeOrder('nickOrigen') !== null)
            || !empty( $this->nickOrigen)) {
            $query->joinWith( 'usuarioOrigen usuo');
        } else {
            $query->with( 'usuarioOrigen');
        }
        if (($sort->getAttributeOrder('nickDestino') !== null)
            || !empty( $this->nickDestino)) {
            $query->joinWith( 'usuarioDestino usud');
        } else {
            $query->with( 'usuarioDestino');
        }*/
        return $dataProvider;
    }
}
