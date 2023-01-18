<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LocalesImagenes]].
 *
 * @see LocalesImagenes
 */
class LocalesImagenesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LocalesImagenes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LocalesImagenes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
