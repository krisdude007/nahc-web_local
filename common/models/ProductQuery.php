<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Product]].
 *
 * @see Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function state($state_id) {

        $providers = ProviderStateMap::find()->select('provider_id')->distinct()->where(['state_id' => $state_id]);

        return $this->andWhere(['in', 'provider_id', $providers]);
    }

    public function ordered() {
        return $this->orderBy('page_order');
    }
}
