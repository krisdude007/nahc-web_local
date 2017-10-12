<?php
namespace frontend\models;

use common\models\Membership;
use common\models\PaymentMethod;
use common\models\Purchase;
use Yii;
use common\models\Member;
use yii\base\Model;
use common\models\User;

/**
 * Member form
 */
class MemberForm extends Member
{
    public $username;
//    public $email;
    public $password;

    public $plan;

    public $acct_f_name;
    public $acct_l_name;
    public $pay_type;
    public $account;
    public $account_type;
    public $routing;
    public $pan;
    public $exp;
    public $cvv;

    const SCENARIO_ENROLL = 'enroll';

    const SCENARIO_PLAN = 'plan';
    const SCENARIO_USER = 'user';
    const SCENARIO_INFO = 'info';
    const SCENARIO_CONTACT = 'contact';
    const SCENARIO_PAY = 'pay';

    const SCENARIO_UPDATE = 'update';

    const SCENARIO_UPGRADE = 'upgrade';


    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [
            [  'plan'
            ],
            'required',
            'on' => [self::SCENARIO_PLAN, self::SCENARIO_UPGRADE, self::SCENARIO_ENROLL],
        ];

        $rules[] = [
            [  'username',
               'password',
               'email'
            ],
            'required',
            'on' => self::SCENARIO_USER
        ];

        $rules[] = [
            [   'f_name',
                'l_name',
                'dobText',
                'gender',
                'ssn',
            ],
            'required',
            'on' => self::SCENARIO_INFO
        ];

        $rules[] = [
            [   'address',
                  //'address2',
                'city',
                'state_id',
                'zip',
                'phone',
            ],
            'required',
            'on' => self::SCENARIO_CONTACT
        ];

        $rules[] = [
            [
                'acct_f_name',
                'acct_l_name',
                'pay_type',
            ],
            'required',
            'on' => [self::SCENARIO_PAY, self::SCENARIO_ENROLL]
        ];

        $rules[] = [
            [   'account',
                'account_type',
                'routing',
            ],
            'required',
            'when' => function($model) { return $model->pay_type == '1'; },
            'whenClient' => "function (attribute, value) { return $('.active > input[name=\"JoinForm[pay_type]\"]').val() == 1; }",
            'on' => [self::SCENARIO_PAY, self::SCENARIO_ENROLL]
        ];

        $rules[] = [
            [   'pan',
                'exp',
                'cvv',
            ],
            'required',
            'when' => function($model) { return $model->pay_type == '2';},
            'whenClient' => "function (attribute, value) { return $('.active > input[name=\"JoinForm[pay_type]\"]').val() == 2; }",
            'on' => [self::SCENARIO_PAY, self::SCENARIO_ENROLL]
        ];

        $rules[] = [
            [   //'plan',
                'f_name',
                'l_name',

                'dobText',
                'gender',
                'ssn',

                'address',
//                    'address2',
                'city',
                'state_id',
                'zip',
                'phone',
                'email',
            ],
            'required',
            'on' => [self::SCENARIO_ENROLL, self::SCENARIO_UPDATE],
        ];


        $rules[] = [['f_name', 'm_name', 'l_name', 'address', 'address2', 'city', 'email', 'acct_f_name', 'acct_l_name', 'username'], 'trim'];

        $rules[] = ['plan', 'integer', 'min' => Membership::MEMBERSHIP_BASIC, 'max' => Membership::MEMBERSHIP_MAX];

//        $rules[] = ['username', 'trim'];
//        $rules[] = ['username', 'required'];
        $rules[] = ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.', 'on' => self::SCENARIO_USER];
        $rules[] = ['username', 'string', 'min' => 2, 'max' => 255];

//        $rules[] = ['email', 'required', 'except' => self::SCENARIO_PII];
        $rules[] = ['email', 'email'];
        $rules[] = ['email', 'string', 'max' => 255];
//        $rules[] = ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.', 'on' => self::SCENARIO_USER_REG];

//        $rules[] = ['password', 'required'];
        $rules[] = ['password', 'string', 'min' => 6];


        $rules[] = [['acct_f_name'], 'string', 'max' => 255];
        $rules[] = [['acct_l_name'], 'string', 'max' => 255];
        $rules[] = [['pay_type'], 'integer', 'min' => '1', 'max' => '2'];
        $rules[] = [['routing'], 'match', 'pattern' => '/^[0-9]{9}$/'];
        $rules[] = [['account'], 'match', 'pattern' => '/^[0-9]{4,17}$/'];
        $rules[] = [['exp'], 'match', 'pattern' => '/^(0[1-9]|1[0-2])\/((19|20)[12][0-9])$/'];
        $rules[] = [['pan'], 'match', 'pattern' => '/^[0-9]{15,16}$/'];
        $rules[] = [['cvv'], 'match', 'pattern' => '/^[0-9]{3}[0-9]?$/'];

        $rules[] = [['account_type'], 'integer', 'min'=>1, 'max'=>2];

//            [['user_id', 'agent_id', 'ext_id', 'status', 'created_at', 'updated_at'], 'integer'],
//            [['dob'], 'safe'],
//            [['f_name', 'l_name', 'm_name', 'address', 'address2', 'city', 'email', 'phone'], 'string', 'max' => 255],
//            [['gender'], 'string', 'max' => 1],
//            [['state'], 'string', 'max' => 2],
//            [['zip'], 'string', 'max' => 5],
//            [['ssn'], 'string', 'max' => 8],
//            [['agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agent::className(), 'targetAttribute' => ['agent_id' => 'id']],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
//        ];

        return $rules;
    }

    /**
     * @inheritdoc
     */
//    public function scenarios()
//    {
//        $scenarios = parent::scenarios();
//        $scenarios[self::SCENARIO_USER_REG] = ['username', 'password', 'email'];
//        $scenarios[self::SCENARIO_JOIN] = ['f_name', 'l_name', 'm_name', 'dob', 'address', 'city', 'state', 'zip', 'email', 'phone', 'ssn', 'gender'];
//        $scenarios[self::SCENARIO_USER] = ['username', 'password', 'email'];
//        $scenarios[self::SCENARIO_PII] = ['f_name', 'l_name', 'm_name', 'dobText', 'ssn', 'gender'];
//        $scenarios[self::SCENARIO_CONTACT] = ['address', 'address2', 'city', 'state', 'zip', 'phone', 'email' ];
//        $scenarios[self::SCENARIO_UPDATE] = ['f_name', 'l_name', 'm_name', 'dob', 'address', 'address2', 'city', 'state', 'zip', 'email', 'phone', 'ssn', 'gender'];
//        $scenarios[self::SCENARIO_PAY] = ['acct_name', 'pay_type', 'routing', 'account', 'exp', 'pan', 'cvv'];
//
//        return $scenarios;
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $names = parent::attributeLabels();

        $names['acct_f_name'] = 'Account First Name';
        $names['acct_l_name'] = 'Account Last Name';
        $names['pay_type'] = 'Payment Type';
        $names['routing'] = 'Routing Code';
        $names['account'] = 'Account Number';
        $names['account_type'] = 'Type';
        $names['exp'] = 'Expiration Date';
        $names['pan'] = 'Card Number';
        $names['cvv'] = 'CVV';

        return $names;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->getIsNewRecord()) {
            $scenario = $this->scenario;

            $activeAttrs = $this->activeAttributes();

            $transaction = Yii::$app->db->beginTransaction();

            if($runValidation && $scenario == self::SCENARIO_USER) {

                if(!$this->validate()) {
                    Yii::info('Validation Failed! S: '.$this->scenario.' AA: '.print_r($activeAttrs,true).' / Errors: '.print_r($this->errors, true));
                    $transaction->rollBack();
                    return false;
                }

                $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->setPassword($this->password);
                $user->generateAuthKey();
                $user->has_member = true;

                if(!$user->save()) {
                    $transaction->rollBack();
                    return false;
                }

                $this->user_id = $user->id;
            }

            $this->setScenario(self::SCENARIO_ENROLL);

            if(!$this->insert($runValidation, $attributeNames)) {
                Yii::info('Errors: '.print_r($this->errors, true));
                $transaction->rollBack();
                return false;
            }

            if(in_array('pay_type', $activeAttrs)) {
                if($runValidation) {
                    $this->setScenario(self::SCENARIO_PAY);

                    if(!$this->validate()) {
                        $transaction->rollBack();
                        return false;
                    }
                }



                $payment = new PaymentMethod([
                    'member_id'     => $this->id,
                    'pay_type'      => $this->pay_type,
                    'f_name'        => $this->acct_f_name,
                    'l_name'        => $this->acct_l_name,
                    'routing'       => $this->routing,
                    'account'       => $this->account,
                    'account_type'  => $this->account_type,
                    'pan'           => $this->pan,
                    'exp'           => $this->exp,
                    'cvv'           => $this->cvv,
                    'status'        => PaymentMethod::STATUS_ACTIVE,
                ]);

//                if($payment->pay_type == PaymentMethod::PAY_TYPE_BANK) {
//                    $payment->pan = null;
//                    $payment->cvv = null;
//                    $payment->exp = null;
//                } else if($this->pay_type == PaymentMethod::PAY_TYPE_CARD) {
//                    $payment->routing = null;
//                    $payment->account = null;
//                    $payment->account_type = null;
//                }

                if(!$payment->save()) {
                    Yii::info('Errors: '.print_r($payment->errors, true));
                    $transaction->rollBack();
                    return false;
                }
            }

            if($scenario == self::SCENARIO_ENROLL) {
                $purchase = Purchase::purchaseMembership($this->plan, $this->id, $payment->id);
            }

            $transaction->commit();



            return true;
        }

        return $this->update($runValidation, $attributeNames) !== false;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        $this->setScenario(self::SCENARIO_USER_REG);

        if (!$this->validate()) {
            return null;
        }

        $transaction = Yii::$app->db->beginTransaction();

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if(!$user->save()) {
            $transaction->rollBack();
            return null;
        }

        $this->user_id = $user->id;

        Yii::info('Email: '.$this->email);

        $this->setScenario(self::SCENARIO_JOIN);

        if(!$this->save()) {
            Yii::info('Errors: '.print_r($this->errors, true));
            $transaction->rollBack();
            return null;
        }

        $purchase = Purchase::purchaseMembership($this->plan, $this->id);

        if(empty($purchase)) {
            $transaction->rollBack();
            return null;
        }

        $transaction->commit();

        return $user;
    }
}