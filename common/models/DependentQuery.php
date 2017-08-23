<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Dependent]].
 *
 * @see Dependent
 */
class DependentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Dependent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Dependent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
