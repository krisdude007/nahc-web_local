<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[State]].
 *
 * @see State
 */
class StateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return State[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return State|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
