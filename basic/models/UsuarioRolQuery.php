<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuarioRol]].
 *
 * @see UsuarioRol
 */
class UsuarioRolQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsuarioRol[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsuarioRol|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    //Función que te lista todos los roles del id_usuario = $id
    public function listar($id)
    { 
        return $this->andWhere(['=', 'id_usuario', $id]);
    }


}
