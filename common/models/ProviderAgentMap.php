<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provider_agent_map".
 *
 * @property integer $provider_id
 * @property integer $agent_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Agent $agent
 * @property Provider $provider
 */
class ProviderAgentMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider_agent_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_id', 'agent_id', 'created_at', 'updated_at'], 'required'],
            [['provider_id', 'agent_id', 'created_at', 'updated_at'], 'integer'],
            [['agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agent::className(), 'targetAttribute' => ['agent_id' => 'id']],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provider_id' => 'Provider ID',
            'agent_id' => 'Agent ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgent()
    {
        return $this->hasOne(Agent::className(), ['id' => 'agent_id'])->inverseOf('providerAgentMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id'])->inverseOf('providerAgentMaps');
    }
}
