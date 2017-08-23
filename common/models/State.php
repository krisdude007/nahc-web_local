<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $name
 * @property string $short_name
 * @property string $long_name
 * @property string $three_letter
 * @property string $two_letter
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AgentStateMap[] $agentStateMaps
 * @property ProductStateMap[] $productStateMaps
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'two_letter'], 'required'],
            [['name', 'short_name', 'long_name'], 'string', 'max' => 255],
            [['three_letter'], 'string', 'max' => 3],
            [['two_letter'],   'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'name' => 'Name',
            'short_name' => 'Short Name',
            'long_name' => 'Long Name',
            'three_letter' => 'Three Letter',
            'two_letter' => 'Two Letter',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getStateList($alpha_key = false)
    {
        if($alpha_key)
            return self::find()->select(['name', 'two_letter'])->indexBy('two_letter')->asArray()->column();
        else
            $list = self::find()->select(['name', 'id'])->indexBy('id')->asArray()->column();

//        Yii::info('List: '.print_r($list, true));

        return $list;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgentStateMaps()
    {
        return $this->hasMany(AgentStateMap::className(), ['state_id' => 'id'])->inverseOf('state');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStateMaps()
    {
        return $this->hasMany(ProductStateMap::className(), ['state_id' => 'id'])->inverseOf('state');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderStateMaps()
    {
        return $this->hasMany(ProviderStateMap::className(), ['state_id' => 'id'])->inverseOf('state');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviders()
    {
        return $this->hasMany(Provider::className(), ['id' => 'provider_id'])->via('providerStateMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderProducts()
    {
        return $this->hasMany(Product::className(), ['provider_id' => 'provider_id'])->via('providerStateMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->via('productStateMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgents()
    {
        return $this->hasMany(Agent::className(), ['id' => 'agent_id'])->via('agentStateMaps');
    }

    /**
     * @inheritdoc
     * @return StateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StateQuery(get_called_class());
    }
}
