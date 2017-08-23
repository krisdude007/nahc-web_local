<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_state_map".
 *
 * @property integer $provider_id
 * @property integer $state_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Provider $provider
 * @property State $state
 */
class ProviderStateMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_state_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'state_id', 'created_at', 'updated_at'], 'required'],
            [['provider_id', 'state_id', 'created_at', 'updated_at'], 'integer'],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provider_id' => 'Provider ID',
            'state_id' => 'State ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id'])->inverseOf('providerStateMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id'])->inverseOf('providerStateMaps');
    }
}
