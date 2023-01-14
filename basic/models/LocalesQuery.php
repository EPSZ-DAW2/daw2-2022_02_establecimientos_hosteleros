<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LocalesMantenimiento]].
 *
 * @see LocalesMantenimiento
 */
class LocalesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LocalesMantenimiento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LocalesMantenimiento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
