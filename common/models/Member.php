<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $agent_id
 * @property integer $ext_id
 * @property integer $group_id
 * @property string $f_name
 * @property string $l_name
 * @property string $m_name
 * @property string $dob
 * @property string $gender
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property integer $state_id
 * @property string $zip
 * @property string $email
 * @property string $phone
 * @property string $ssn
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sync_at
 *
 * @property Dependent[] $dependants
 * @property Agent $agent
 * @property User $user
 * @property Purchase[] $purchases
 * @property Membership $membership
 * @property State  $state
 * @property ProductOption[] $productOptions
 */
class Member extends \yii\db\ActiveRecord
{
    private $_dobText;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
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
            [['f_name', 'l_name', 'dob', 'address', 'city', 'state', 'zip', 'email', 'phone', 'ssn', 'gender'], 'required'],

            [['user_id', 'agent_id', 'ext_id', 'status', 'created_at', 'updated_at'], 'integer'],

            [['dob'], 'date', 'format' => 'php:Y-m-d', 'max' => \Yii::$app->formatter->asDate(strtotime( '-18 years', strtotime( date('Y-m-d') ) ), 'php:Y-m-d')],
            [['dobText'], 'date', 'format' => 'MM/dd/yyyy', 'message' => 'Members must be at least 18 years of age.', 'max' => \Yii::$app->formatter->asDate(strtotime( '-18 years', strtotime( date('m/d/Y') ) ), 'MM/dd/yyyy')],
            [['f_name', 'l_name', 'm_name', 'address', 'address2', 'city', 'email', 'phone'], 'string', 'max' => 255],
            [['gender'], 'match', 'pattern' => '/^[MF]{1}$/'],
//            [['gender'], 'string', 'max' => 1],
            [['state_id'], 'integer', 'min' => 1, 'max' => 56],
//            [['state'], 'match', 'pattern' => '/^[A-Z]{2}$/'],
//            [['zip'], 'string', 'max' => 5],
            [['zip'], 'match', 'pattern' => '/^[0-9]{5}$/'],
            [['phone'], 'match', 'pattern' => '/^[0-9]{10}$/'],
            [['ssn'], 'match', 'pattern' => '/^[0-9]{9}$/'],
//            [['ssn'], 'string', 'max' => 8],
            [['agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agent::className(), 'targetAttribute' => ['agent_id' => 'id']],
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
            'agent_id' => 'Agent ID',
            'ext_id' => 'Ext ID',
            'f_name' => 'First Name',
            'l_name' => 'Last Name',
            'm_name' => 'Middle Name',
            'dob' => 'Date of Birth',
            'dobText' => 'Date of Birth',
            'gender' => 'Gender',
            'address' => 'Address',
            'address2' => 'Address 2',
            'city' => 'City',
            'state_id' => 'State',
            'zip' => 'Zip',
            'email' => 'Email',
            'phone' => 'Phone',
            'ssn' => 'Social Security Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getLevel()
    {
        if(empty($this->membership))
            return null;

        return $this->membership->id;
    }

    public function getDobText()
    {
        Yii::info('getDobText: '.print_r($this->_dobText, true).' / '.print_r($this->dob, true));

        if(empty($this->_dobText)) {

            if(empty($this->dob)) {
                return '';
            }

            return \Yii::$app->formatter->asDate($this->dob, 'MM/dd/yyyy');
        }
        else {
            return $this->_dobText;
        }
    }

    public function setDobText($date)
    {
        try {
            Yii::info('setDobText: '.print_r($date, true));

            $dob = \Yii::$app->formatter->asDate($date, 'php:Y-m-d');

            $this->dob = $dob;

            $this->_dobText = null;
        }
        catch (\Exception $e) {
            $this->_dobText = $date;
        }
    }

    public function getNameText($m_name = true)
    {
        $name = $this->f_name.' ';

        if(!empty($this->m_name) && $m_name) {
            $name .= $this->m_name.' ';
        }

        $name .= $this->l_name;

        return $name;
    }

    public function getPhoneText()
    {
        $pattern = '/([0-9]{3})([0-9]{3})([0-9]{4})/i';
        $replacement = '($1)$2-$3';
        return preg_replace($pattern, $replacement, $this->phone);

//        return $this->phone;
    }

    public function getSsnText()
    {
        $pattern = '/([0-9]{3})-([0-9]{2})-([0-9]{4})/i';
        $replacement = '***-**-$3';
        return preg_replace($pattern, $replacement, $this->ssn);

//        return $this->phone;
    }

    public function getStateText($full = false)
    {
        if(empty($this->state_id))
            return '';

        if($full)
            return $this->state->name;

        return $this->state->two_letter;
    }

    public function getActiveDateText()
    {
        $activeDate = $this->activeDate;

        if(empty($activeDate))
            return '';

        return \Yii::$app->formatter->asDate($activeDate,'MM/dd/yyyy');
    }

    public function getActiveDate()
    {
        $purchase = $this->getPurchases()->andWhere(['type' => Purchase::PURCHASE_TYPE_MEMBERSHIP/*, 'status' => 10*/])->one();

        if(empty($purchase))
            return null;

        return $purchase->active_date;
    }

    public function getRecurringBillDay()
    {
        $purchase = $this->getPurchases()->andWhere(['type' => Purchase::PURCHASE_TYPE_MEMBERSHIP/*, 'status' => 10*/])->one();

        if(empty($purchase))
            return null;

        return $purchase->recurring_bill_day;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependents()
    {
        return $this->hasMany(Dependent::className(), ['member_id' => 'id'])->inverseOf('member');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgent()
    {
        return $this->hasOne(Agent::className(), ['id' => 'agent_id'])->inverseOf('members');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('members');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['member_id' => 'id'])->inverseOf('member');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembership()
    {
//        /* @var Purchase $purchase */
//
//        $purchase = $this->getPurchases()->andWhere(['type' => 1])->orderBy('updated_at')->one();
//
//        if(empty($purchase))
//            return null;
//
////        Yii::info('Purchase: '.print_r($purchase, true));
//
//        return $purchase->membership;

        return $this->hasOne(Membership::className(), ['id' => 'membership_id'])->via('purchases')->orderBy('updated_at');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptions()
    {
        return $this->hasMany(ProductOption::className(), ['id' => 'product_option_id'])->via('purchases');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->via('productOptions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['member_id' => 'id'])->where(['status' => PaymentMethod::STATUS_ACTIVE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethods()
    {
        return $this->hasMany(PaymentMethod::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    /**
     * @inheritdoc
     * @return MemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemberQuery(get_called_class());
    }
}
