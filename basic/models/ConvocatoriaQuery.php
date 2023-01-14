<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Convocatoria]].
 *
 * @see Convocatoria
 */
class ConvocatoriaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Convocatoria[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Convocatoria|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
