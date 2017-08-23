<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class E123Member extends Model {

    const MODE_ADD = 1;
    const MODE_UPDATE = 2;

    public $mode = self::MODE_ADD;

    public $agent;
    public $uniqueid;
    public $firstname;
    public $middlename;
    public $lastname;
    public $dob;
    public $gender;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $zipcode;
    public $email;
    public $phone1;
    public $phone2;
    public $phone3;
    public $fax;
    public $dlnumber;
    public $ssn;
    public $lead;
    public $createddate;
    public $source;
    public $sourcedetail;
    public $tpvdatetime;
    public $tpvcode;
    public $paymentprocess;


    public $payment;
//    public $payment_paymenttype;
//    public $payment_cctype;
//    public $payment_ccnumber;
//    public $payment_ccexpmonth;
//    public $payment_ccexpyear;
//    public $payment_ccsecuritycode;
//    public $payment_achtype;
//    public $payment_achrouting;
//    public $payment_achaccount;
//    public $payment_achbank;
//    public $payment_firstname;
//    public $payment_lastname;
//    public $payment_address;
//    public $payment_city;
//    public $payment_state;
//    public $payment_zipcode;


    public $products = [];
    public $dependents = [];

    private $memberMap = [
        'firstname' => 'f_name',
        'middlename' => 'm_name',
        'lastname' => 'l_name',
        'dob' => 'dob',
        'gender' => 'gender',
        'address1' => 'address',
        'address2' => 'address2',
        'city' => 'city',
        'state' => 'stateText',
        'zipcode' => 'zip',
        'phone1' => 'phone',
        'email' => 'email',
        'ssn' => 'ssn',
    ];

    private $memberFormat = [
        'dob' => 'date',
        'gender' => 'gender',
        'ssn' => 'ssn',
    ];

    private $purchaseMap = [
        'pdid' => 'extId',
        'dtEffective' => 'active_date',
        'dtCreated' => 'purchase_date',
        'dtBilling' => 'initialDate',
        'dtRecurring' => 'recurringDate',
    ];

    private $productFormat = [
        'dtEffective' => 'date',
        'dtCreated' => 'date',
        'dtBilling' => 'date',
        'dtRecurring' => 'date',
    ];

    public function fields()
    {
        $fields = parent::fields();

        // remove fields that contain sensitive information
        unset($fields['mode']);

        return $fields;
    }

    public static function getModelFromMember(Member $member) {
        if(empty($member))
            return null;

        $api = ArrayHelper::getValue(Yii::$app->components, 'e123', null);

        if(empty($api))
            return null;

        $model = new E123Member();

        foreach($model->memberMap as $ef => $mf) {
            $model[$ef] = $member[$mf];
        }

        $model->formatFields();

        return $model;
    }

    public static function getModelFromPurchase(Purchase $purchase)
    {
        if(empty($purchase))
            return null;

        $member = $purchase->member;

        $payment = $purchase->paymentMethod;

        $extId = $purchase->extId;

        $model = self::getModelFromMember($member);

        $model->addPayment($payment);

        $prodAr = [
            'pdid' => intval($extId),
            'dtEffective' => $purchase->activeDateText,
            'dtBilling' =>  $purchase->initialDateText,
            'dtRecurring' =>  $purchase->recurringDateText,
            'dtCreated' => $purchase->purchaseDateText,
            'bPaid' => 'Y',
//            'benefitid' => 51,
        ];

        $model->products[] = $prodAr;

        return $model;
    }

    public function addPayment($pay)
    {
        if(empty($pay))
            return false;

        $this->payment = [];

        switch($pay->pay_type) {
            case PaymentMethod::PAY_TYPE_BANK:
                $this->payment['paymenttype'] = 'ACH';
                $this->payment['achrouting'] = $pay->routing;
                $this->payment['achaccount'] = $pay->account;
                $this->payment['achbank'] = $pay->bankName;
                break;
            case PaymentMethod::PAY_TYPE_CARD:
                $this->payment['paymenttype'] = 'CC';
                $this->payment['ccnumber'] = $pay->pan;
                $this->payment['ccexpmonth'] = $pay->expMonth;
                $this->payment['ccexpyear'] = $pay->expYear;
                $this->payment['ccsecuritycode'] = $pay->cvv;
                break;
            default:
                return false;
        }

        return true;
    }

    public function formatFields($fmt = null, $set = null) {
        if(empty($fmt))
            $fmt = $this->memberFormat;

        if(empty($set))
            $set = $this;

        foreach($fmt as $mf => $type) {
            switch ($type) {
                case 'date': // convert database date to mm/dd/yyyy
                    $set[$mf] = \Yii::$app->formatter->asDate($this[$mf], 'MM/dd/yyyy') ;
                    break;
                case 'gender':
                    if($set[$mf] == 1)
                        $set[$mf] = 'M';
                    elseif($set[$mf] == 2)
                        $set[$mf] = 'F';
                    break;
                case 'ssn':
                    $pattern = '/([0-9]{3})-([0-9]{2})-([0-9]{4})/i';
                    $replacement = '$1-$2-$3';
                    $set[$mf] = preg_replace($pattern, $replacement, $set[$mf]);
                    break;
                default:
                    $this[$mf] = $this[$mf];
                    break;
            }
        }
    }
}