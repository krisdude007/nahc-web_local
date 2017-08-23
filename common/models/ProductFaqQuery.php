<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProductFaq]].
 *
 * @see ProductFaq
 */
class ProductFaqQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProductFaq[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductFaq|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
