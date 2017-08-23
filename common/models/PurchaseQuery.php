<?php
namespace common\models;

use yii\db\ActiveQuery;
use yii\db\Connection;

/**
 * This is the ActiveQuery class for [[Purchase]].
 *
 * @see Purchase
 */
class PurchaseQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Purchase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Purchase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param Connection $db the DB connection used to create the DB command.
     * If null, the DB connection returned by [[modelClass]] will be used.
     * @return Product[]|null
     */
    public function products($db = null)
    {
        $all = $this->distinct()->with('product')->all($db);

        $products = [];

        foreach($all as $purchase)
        {
            if(!empty($purchase->product))
                $products[] = $purchase->product;
        }

        return $products;
    }
}
