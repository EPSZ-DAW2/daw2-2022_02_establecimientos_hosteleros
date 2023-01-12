<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Usuarioaviso]].
 *
 * @see Usuarioaviso
 */
class UsuarioavisoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Usuarioaviso[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Usuarioaviso|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
