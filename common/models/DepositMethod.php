<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deposit_method".
 *
 * @property integer $id
 * @property integer $agent_id
 * @property string $acct_name
 * @property string $routing
 * @property string $account
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Agent $agent
 */
class DepositMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deposit_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agent_id', 'acct_name', 'created_at', 'updated_at'], 'required'],
            [['agent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['acct_name', 'account'], 'string', 'max' => 255],
            [['routing'], 'string', 'max' => 9],
            [['agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agent::className(), 'targetAttribute' => ['agent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agent_id' => 'Agent',
            'acct_name' => 'Name on Account',
            'routing' => 'Bank Routing Number',
            'account' => 'Bank Account Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgent()
    {
        return $this->hasOne(Agent::className(), ['id' => 'agent_id'])->inverseOf('depositMethods');
    }

    /**
     * @inheritdoc
     * @return DepositMethodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepositMethodQuery(get_called_class());
    }
}
