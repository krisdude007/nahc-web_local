<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[DepositMethod]].
 *
 * @see DepositMethod
 */
class DepositMethodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return DepositMethod[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DepositMethod|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
