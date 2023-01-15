<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuariosLocales]].
 *
 * @see UsuariosLocales
 */
class UsuariosLocalesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsuariosLocales[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsuariosLocales|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
