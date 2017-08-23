<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "payment_method".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $name
 * @property integer $pay_type
 * @property string $acct_name
 * @property string $routing
 * @property string $account
 * @property integer $account_type
 * @property string $exp
 * @property string $pan
 * @property string $cvv
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property integer $panText
 * @property integer $accountText
 *
 * @property Member $member
 * @property Purchase[] $purchases
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    const PAY_TYPE_BANK = 1;
    const PAY_TYPE_CARD = 2;

    const ACCT_TYPE_CHECKING = 1;
    const ACCT_TYPE_SAVINGS = 2;

    const STATUS_CREATED = 10;
    const STATUS_ACTIVE = 50;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method';
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
            [['member_id', 'pay_type', 'acct_name'], 'required'],
            [['member_id', 'pay_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'acct_name'], 'string', 'max' => 255],
//            [['routing'], 'string', 'max' => 9],
//            [['exp'], 'string', 'max' => 7],
//            [['pan', 'panText'], 'string', 'max' => 16],
//            [['cvv'], 'string', 'max' => 4],

            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],

            [['account', 'accountText', 'routing'], 'required', 'when' => function($model) { return $model->pay_type == '1'; }, 'whenClient' => "function (attribute, value) { return $('.active > input[name=\"PaymentMethod[pay_type]\"]').val() == 1; }"],

            [['pan', 'panText', 'exp', 'cvv'],  'required', 'when' => function($model) { return $model->pay_type == '2'; }, 'whenClient' => "function (attribute, value) { return $('.active > input[name=\"PaymentMethod[pay_type]\"]').val() == 2; }"],

            [['pay_type'], 'integer', 'min' => '1', 'max' => '2'],

            [['routing'],   'match', 'pattern' => '/^[0-9]{9}$/'],
            [['account'],   'match', 'pattern' => '/^[0-9]{4,17}$/'],

            [['exp'],       'match', 'pattern' => '/^(0[1-9]|1[0-2])\/((19|20)[12][0-9])$/'],
            [['pan'],       'match', 'pattern' => '/^[0-9]{15,16}$/'],
            [['cvv'],       'match', 'pattern' => '/^[0-9]{3}[0-9]?$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'name' => 'Name',
            'pay_type' => 'Payment Type',

            'acct_name' => 'Name on Account',
            'routing' => 'Bank Routing Number',
            'account' => 'Bank Account Number',
            'accountText' => 'Bank Account Number',

            'account_type' => 'Bank Account Type',

            'pan' => 'Card Number',
            'panText' => 'Card Number',

            'exp' => 'Card Expiration Date',
            'cvv' => 'Card Verification Code',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    private function mask($str) {
        return substr_replace($str,"************",0,-4);
    }

    public function getPayTypeText()
    {
        switch ($this->pay_type) {
            case 1:
                return 'Bank Account';
                break;
            case 2:
                return 'Credit Card';
                break;
            default:
                return 'N/A';
                break;
        }
    }

    public static function getAcctTypes()  {
        return [
            self::ACCT_TYPE_CHECKING => 'Checking',
            self::ACCT_TYPE_SAVINGS => 'Savings',
        ];
    }

    public function getAcctTypeText()
    {
        switch ($this->account_type) {
            case 1:
                return 'Checking';
                break;
            case 2:
                return 'Savings';
                break;
            default:
                return 'N/A';
                break;
        }
    }

    public function getPanText()
    {
        if(empty($this->pan))
            return '';

        return $this->mask($this->pan);
    }

    public function setPanText($new_pan)
    {
        if(empty($new_pan))
            $this->pan = null;

        // TODO: VALIDATE PAN

        $this->pan = $new_pan;
    }

    public function getAccountText()
    {
        if(empty($this->account))
            return '';

        return $this->mask($this->account);
    }

    public function setAccountText($new_acct)
    {
        if(empty($new_acct))
            $this->account = null;

        // TODO: VALIDATE ACCT

        $this->account = $new_acct;
    }

    public function getRoutingText()
    {
        if(empty($this->routing))
            return '';

        $fedach = FedAch::find()->where(['routing_num' => $this->routing])->one();

        if(empty($fedach))
            return $this->routing;

        return $this->routing.' - '.$fedach->name;
    }

    public function getBankName()
    {
        if(empty($this->routing))
            return '';

        $fedach = FedAch::find()->where(['routing_num' => $this->routing])->one();

        if(empty($fedach))
            return '';

        return $fedach->name;
    }

    public function getExpMonth()
    {
        if(empty($this->exp))
            return '';

        $exp = explode('/',$this->exp);

        if(empty($exp))
            return '';

        return $exp[0];
    }

    public function getExpYear()
    {
        if(empty($this->exp))
            return '';

        $exp = explode('/',$this->exp);

        if(empty($exp))
            return '';

        return $exp[1];
    }

    public function getAcctFirstName()
    {

    }

    public function getAcctLastName()
    {

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id'])->inverseOf('paymentMethods');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['payment_id' => 'id'])->inverseOf('paymentMethod');
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     */
    public function getFedAch()
    {
        return $this->hasOne(FedAch::className(), ['routing_num' => 'routing']);
    }

    /**
     * @inheritdoc
     * @return PaymentMethodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentMethodQuery(get_called_class());
    }
}
