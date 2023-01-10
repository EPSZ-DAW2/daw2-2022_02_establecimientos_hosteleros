<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuarioAreaModeracion]].
 *
 * @see UsuarioAreaModeracion
 */
class UsuarioAreaModeracionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsuarioAreaModeracion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsuarioAreaModeracion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
