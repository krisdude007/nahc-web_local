<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "agent".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $parent_id
 * @property string $ext_id
 * @property string $f_name
 * @property string $m_name
 * @property string $l_name
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $email
 * @property string $phone
 * @property string $organization
 * @property string $title
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property AgentStateMap[] $agentStateMaps
 * @property DepositMethod[] $depositMethods
 * @property Member[] $members
 * @property ProviderAgentMap[] $providerAgentMaps
 *
 */
class Agent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agent';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'parent_id', 'state_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['f_name', 'l_name', 'address', 'address2', 'city', 'email', 'state', 'zip', 'phone'], 'required'],
            [['ext_id', 'f_name', 'm_name', 'l_name', 'address', 'address2', 'city', 'email', 'organization', 'title'], 'string', 'max' => 255],
            [['zip'], 'string', 'max' => 5],
            [['phone'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'parent_id' => 'Parent ID',
            'ext_id' => 'External ID',
            'f_name' => 'First Name',
            'm_name' => 'Middle Name',
            'l_name' => 'Last Name',
            'address' => 'Address',
            'address2' => 'Address 2',
            'city' => 'City',
            'state_id' => 'State',
            'zip' => 'Zip',
            'email' => 'Email',
            'phone' => 'Phone',
            'organization' => 'Organization Name',
            'title' => 'Job Title',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getPhoneText()
    {
        $pattern = '/([0-9]{3})([0-9]{3})([0-9]{4})/i';
        $replacement = '($1) $2-$3';
        return preg_replace($pattern, $replacement, $this->phone);

//        return $this->phone;
    }

    public function getNameText()
    {
        return $this->f_name.' '.$this->l_name;
    }

    /**
     * @return string
     */
    public function getStateText()
    {
        return $this->state->name;
    }


//    public function getProducts()
//    {
//        return Product::find()->all();
//    }

    public function getProductsByState($state)
    {
        return Product::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id'])->inverseOf('agents');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('agents');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgentStateMaps()
    {
        return $this->hasMany(AgentStateMap::className(), ['agent_id' => 'id'])->inverseOf('agent');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepositMethods()
    {
        return $this->hasMany(DepositMethod::className(), ['agent_id' => 'id'])->inverseOf('agent');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['agent_id' => 'id'])->inverseOf('agent');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderAgentMaps()
    {
        return $this->hasMany(ProviderAgentMap::className(), ['agent_id' => 'id'])->inverseOf('agent');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgents()
    {
        return $this->hasMany(Agent::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(State::className(), ['id' => 'state_id'])->via('agentStateMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviders()
    {
        return $this->hasMany(Provider::className(), ['id' => 'provider_id'])->via('providerAgentMaps');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['provider_id' => 'id'])->via('providers');
    }

    /**
     * @return Product[]|null
     */
    public function getProductList($state = null)
    {
        $providers = ProviderStateMap::find()
                        ->select('provider_id')
                        ->distinct()
                        ->join('INNER JOIN', 'agent_state_map', 'agent_state_map.state_id = provider_state_map.state_id')
                        ->where(['agent_id' => $this->id])
                        ->andFilterWhere(['provider_state_map.state_id' => $state]);

        $query = Product::find()->where(['in', 'provider_id', $providers])->indexBy('id')->ordered();

        $models = $query->all();

//        return $this->hasMany(Product::className(), ['provider_id' => 'provider_id'])->where(['in', 'provider_id', $providers]);

        return $models;
    }

    /**
     * @inheritdoc
     * @return AgentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgentQuery(get_called_class());
    }

    /**
     * @return boolean
     */
    public function checkState($state_id) {
        $agentStateMap = AgentStateMap::find()->where(['agent_id' => $this->id, 'state_id' => $state_id]);

        if(empty($agentStateMap)) {
            return false;
        }

        return true;
    }
}
