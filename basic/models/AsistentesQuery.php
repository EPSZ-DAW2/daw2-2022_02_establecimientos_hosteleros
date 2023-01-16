<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Asistente]].
 *
 * @see Asistente
 */
class AsistentesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Asistente[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Asistente|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
<<<<<<< Updated upstream
=======
    public function listar($id)
    { 
        return $this->andWhere(['=', 'convocatoria_id', $id]);
    }
    public function comprobar_asistencia($id_asi,$id_conv)
    {
>>>>>>> Stashed changes

    public function listar($id)
    { 
        return $this->andWhere(['=', 'convocatoria_id', $id]);
    }
}
