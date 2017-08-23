<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProductOption]].
 *
 * @see ProductOption
 */
class ProductOptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProductOption[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductOption|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
