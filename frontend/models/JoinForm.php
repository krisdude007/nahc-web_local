<?php
namespace frontend\models;

use common\components\Utils;
use common\models\FedAch;
use common\models\Membership;
use common\models\Purchase;
use common\models\State;
use Yii;
use common\models\Member;
use yii\base\Model;
use common\models\User;

/**
 * Join form
 */
class JoinForm extends Model
{
    public $plan;

    public $username;
    public $password;
    public $repeat_password;
    public $email;

    public $f_name;
    public $m_name;
    public $l_name;
    public $dob;
    public $gender;
    public $ssn;

    public $address;
    public $address2;
    public $city;
    public $state_id;
    public $zip;
    public $phone;

    public $acct_f_name;
    public $acct_l_name;
    public $pay_type;
    public $account;
    public $account_type;
    public $routing;
    public $pan;
    public $exp;
    public $cvv;

    public $agree_pay;
    public $agree_member;

    private $_dobText;

    const WIZARD_LOAD = 'load';
    const WIZARD_STEP_1 = 'step1';
    const WIZARD_STEP_2 = 'step2';
    const WIZARD_STEP_3 = 'step3';
    const WIZARD_STEP_4 = 'step4';
    const WIZARD_STEP_5 = 'step5';
    const WIZARD_STEP_6 = 'step6';
    const WIZARD_STEP_7 = 'step7';

    public function rules()
    {
        $rules = [

            [[  'plan',
                'username',
                'password',
                'repeat_password',
                'email',
                'f_name',
                'm_name',
                'l_name',
                'dobText',
                'gender',
                'ssn',
                'address',
                'address2',
                'city',
                'state_id',
                'zip',
                'phone',
                'acct_f_name',
                'acct_l_name',
                'pay_type',
                'account',
                'account_type',
                'agree_member',
                'agree_pay',
                'routing',
                'pan',
                'exp',
                'cvv',
            ], 'safe', 'on' => self::WIZARD_LOAD],

            [[  'plan'], 'required', 'on' => self::WIZARD_STEP_1],

            [[  'username',
                'password',
                'repeat_password',
                'email'
            ], 'required', 'on' => self::WIZARD_STEP_2],

            [[   'f_name',
                'l_name',
                'dobText',
                'gender',
                'ssn',
            ], 'required', 'on' => self::WIZARD_STEP_3],

            [[   'address',
    //            'address2',
                'city',
                'state_id',
                'zip',
                'phone',
            ], 'required', 'on' => self::WIZARD_STEP_4],

            [[  'acct_f_name',
                'acct_l_name',
                'pay_type',
            ], 'required', 'on' => self::WIZARD_STEP_5],

            [[  'agree_member',
                'agree_pay',
            ], 'required', 'on' => self::WIZARD_STEP_6, 'requiredValue' => 1, 'message' => 'Agreement Required To Continue'],

            [[  'account',
                'routing',
                'account_type',
             ],'required', 'when' => function($model) {
                return $model->pay_type == '1';
            },'whenClient' => "function (attribute, value) {
                    return $('.active > input[name=\"JoinForm[pay_type]\"]').val() == 1;
            }", 'on' => self::WIZARD_STEP_5],

            [[  'pan',
                'exp',
                'cvv',],'required', 'when' => function($model) {
                return $model->pay_type == '2';
            }, 'whenClient' => "function (attribute, value) {
                    return $('.active > input[name=\"JoinForm[pay_type]\"]').val() == 2;
            }",'on' => self::WIZARD_STEP_5],

            [['f_name', 'l_name', 'm_name', 'address', 'address2', 'city', 'email', 'username', 'acct_f_name', 'acct_l_name',], 'trim'],
            [['f_name', 'l_name', 'm_name', 'address', 'address2', 'city', 'email', 'username', 'acct_f_name', 'acct_l_name',], 'string', 'max' => 255],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['email'], 'email'],

            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => 6, 'max' => 255],
            ['repeat_password', 'string', 'min' => 6, 'max' => 255],
            ['repeat_password', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Passwords don't match"],


            [['dobText'], 'match', 'pattern' => '/^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/((19|20)[0-9]{2})$/'],
//            [['dobText'], 'date', 'format' => 'short', 'max' => \Yii::$app->formatter->asDate(time(), 'MM/dd/yyyy')],
            [['dobText'], 'date', 'format' => 'short', 'message' => 'Members must be at least 18 years of age.', 'max' => \Yii::$app->formatter->asDate(strtotime( '-18 years', strtotime( date('m/d/Y') ) ), 'MM/dd/yyyy')],
            [['dob'], 'date', 'format' => 'php:Y-m-d', 'max' => \Yii::$app->formatter->asDate(strtotime( '-18 years', strtotime( date('m/d/Y') ) ), 'php:Y-m-d')],
//            [['phone'], 'string', 'max' => 10],
            [['gender'], 'match', 'pattern' => '/^[MF]$/'],
//            [['gender'], 'string', 'max' => 1],
            [['state_id'], 'integer', 'min'=> 1, 'max' => 56],
//            [['state'], 'match', 'pattern' => '/^[A-Z]{2}$/'],
//            [['state'], 'in', 'range' => array_keys(Utils::getStates())],
//            [['zip'], 'string', 'max' => 5],
            [['zip'], 'match', 'pattern' => '/^[0-9]{5}$/'],
            [['ssn'], 'match', 'pattern' => '/^[0-9]{9}$/'],
            [['phone'], 'match', 'pattern' => '/^[0-9]{10}$/'],

            [['pay_type'], 'integer', 'min' => '1', 'max' => '2'],

            [['routing'], 'match', 'pattern' => '/^[0-9]{9}$/'],
            ['routing', 'filter', 'filter' => function ($value) {
                // remove leading
                return $value;
            }],
            ['routing', 'exist', 'targetClass' => '\common\models\FedAch', 'targetAttribute' => 'routing_num', 'message' => 'Routing number invalid'],
            [['account'], 'match', 'pattern' => '/^[0-9]{4,17}$/'],

            [['account_type'], 'integer', 'min'=>1, 'max'=>2],

            [['exp'], 'match', 'pattern' => '/^(0[1-9]|1[0-2])\/(201[7-9]|20[234][0-9])$/', 'message' => 'Please Double-Check Expiration Date'],
            [['pan'], 'match', 'pattern' => '/^[0-9]{15,16}$/'],
            [['cvv'], 'match', 'pattern' => '/^[0-9]{3}[0-9]?$/'],

//            ['agree_member', 'required', 'on' => ['register'], ]
            // TODO: conditional based on PAN digits
        ];

        return $rules;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::WIZARD_STEP_7] = [];
        return $scenarios;
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
            'nameText' => 'Name',

            'dob' => 'Date of Birth',
            'dobText' => 'Date of Birth',

            'gender' => 'Gender',
            'genderText' => 'Gender',

            'address' => 'Address',
            'address2' => 'Address 2',
            'city' => 'City',
            'state_id' => 'State',
            'zip' => 'Zip',
            'email' => 'Email',

            'phone' => 'Phone',
            'phoneText' => 'Phone',

            'ssn' => 'Social Security Number',
            'ssnText' => 'Social Security Number',

            'pay_type' => 'Payment Type',

            'acct_f_name' => 'Account First Name',
            'acct_l_name' => 'Account Last Name',

            'routing' => 'Routing Code',
            'routingText' => 'Routing Code',

            'account' => 'Account Number',
            'accountText' => 'Account Number',

            'account_type' => 'Type',

            'pan' => 'Card Number',
            'panText' => 'Card Number',

            'exp' => 'Card Expiration Date',
            'cvv' => 'CVV',

            'passwordText' => 'Password',

            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getDobText()
    {
        if(empty($this->_dobText)) {
            try {

                if(empty($this->dob)) {
                    return '';
                }

                return \Yii::$app->formatter->asDate($this->dob, 'MM/dd/yyyy');
            }
            catch (\Exception $e) {
                return null;
            }
        }
        else {
            return $this->_dobText;
        }
    }

    public function setDOBText($date)
    {
        try {
            $dob = \Yii::$app->formatter->asDate($date, 'php:Y-m-d');

            Yii::info('setDOBText: '.$date.'::'.$dob);

            $this->dob = $dob;

            $this->_dobText = null;
        }
        catch (\Exception $e) {
            $this->_dobText = null;
            $this->dob = null;
        }
    }

    public function getNameText()
    {
        if(empty($this->m_name))
            return $this->f_name.' '.$this->l_name;
        else
            return $this->f_name.' '.$this->m_name.' '.$this->l_name;
    }

    public function getSsnText()
    {
        return '***-**-****';
    }

    public function getStateText()
    {
        $state = State::findOne($this->state_id);

        if(empty($state))
            return null;

        return $state->name;
    }

    public function getAddressText($html = false)
    {
        $addr = $this->address;
        if($html)
            $addr .= '<br>';
        $addr .= PHP_EOL;

        if(!empty($this->address2)) {
            $addr .= $this->address2;
            if($html)
                $addr .= '<br>';
            $addr .= PHP_EOL;
        }

        $addr .= $this->city.', ';
        $addr .= $this->getStateText().' ';
        $addr .= $this->zip;

        if($html)
            $addr .= '<br>';
        $addr .= PHP_EOL;

        return $addr;
    }

    public function getPasswordText()
    {
        return '********';
    }

    public function getAccountText()
    {
        return '********';
    }

    public function getPanText()
    {
        return '********';
    }

    public function getRoutingText()
    {
        $fedach = FedAch::find()->where(['routing_num' => $this->routing])->one();

        if(!empty($fedach))
            return $this->routing.' - '.$fedach->name;

        return $this->routing;
    }

    public function getPhoneText()
    {
        if(empty($this->phone))
            return '';

        $out = '('.substr($this->phone,0,3).') '.substr($this->phone,3,3).'-'.substr($this->phone,6,4);

        return $out;
    }

    public function getAccountName()
    {
        return $this->acct_f_name.' '.$this->acct_l_name;
    }
}