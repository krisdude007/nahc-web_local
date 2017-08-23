<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "purchase".
 *
 * @property string $id
 * @property string $uuid
 * @property integer $member_id
 * @property integer $payment_id
 * @property integer $type
 * @property integer $product_id
 * @property integer $membership_id
 * @property integer $status
 * @property integer $purchase_date
 * @property integer $active_date
 * @property integer $recurring_bill_day
 * @property integer $initial_bill_day
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Member $member
 * @property Membership $membership
 * @property ProductOption $productOption
 * @property Product $product
 * @property PaymentMethod $paymentMethod
 * @property integer $extId
 * @property string $activeDateText
 * @property string $initialDateText
 * @property string $recurringDateText
 * @property string $purchaseDateText
 *
 */
class Purchase extends \yii\db\ActiveRecord
{
    const PURCHASE_TYPE_MEMBERSHIP = 1;
    const PURCHASE_TYPE_PRODUCT = 2;

    const STATUS_SET_TERMINATED = 90;
    const STATUS_TERMINATED = 95;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase';
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
            [['member_id', 'type',], 'required'],

            [['membership_id'], 'required', 'when' => function ($model) { return $model->type === self::PURCHASE_TYPE_MEMBERSHIP;}],
            [['product_option_id'], 'required', 'when' => function ($model) { return $model->type === self::PURCHASE_TYPE_PRODUCT;}],

            [['member_id', 'type', 'product_option_id', 'membership_id', 'status', 'created_at', 'updated_at'], 'integer'],

            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['membership_id'], 'exist', 'skipOnError' => true, 'targetClass' => Membership::className(), 'targetAttribute' => ['membership_id' => 'id']],
            [['product_option_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductOption::className(), 'targetAttribute' => ['product_option_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['payment_id' => 'id']],
            // TODO: VERIFY PAYMENT IS ACTIVE AND OWNED BY MEMBER_ID!
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
            'payment_id' => 'Payment Method',
            'type' => 'Purchase Type',
            'product_option_id' => 'Product ID',
            'membership_id' => 'Membership ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'purchase_date' => 'Initial Purchase Date',
            'active_date' => 'Active Date',
            'recurring_bill_day' => 'Recurring Bill Day of Month',
            'initial_bill_day' => 'Initial Billing Day of Month',
        ];
    }

    private function calculateBillDay($date = null)
    {
        if(empty($date))
            $dt = $this->active_date;
        else
            $dt = strtotime($date);

        $dayNum = date("d",$dt);
        if($dayNum < 5 || $dayNum > 24) {
            return 5;
        } elseif($dayNum > 4 && $dayNum < 15) {
            return 15;
        } else {
            return 25;
        }
    }

    private function calculateDateFromDay($day, $baseDate = null)
    {
        if(empty($day))
            return null;

        if(empty($baseDate))
            $dt = strtotime(date('Y-m-d', time()));
        else
            $dt = $baseDate;

        $dayNumBase = date('d',$dt);
        $dayNum = $day;
        $monthNum = date("m", $dt);
        $yearNum = date("Y", $dt);

        if($dayNum < $dayNumBase) {
            if($monthNum < 12) {
                $monthNum++;
            } else {
                $monthNum = 1;
                $yearNum++;
            }
        }

        $timeStr = $monthNum.'/'.$dayNum.'/'.$yearNum;

        $ts = strtotime($timeStr);

        Yii::info('calculateDateFromDay from base '.date('Y-m-d', $dt).'('.$dt.') to '.$timeStr.'('.strtotime($timeStr).')');

        return $ts;
    }

    private function calculateRecurringBillDay()
    {
        $memPurchase = Purchase::find()->where(['member_id'=>$this->member_id, 'type'=>self::PURCHASE_TYPE_MEMBERSHIP])->one();

        if(empty($memPurchase))
            return $this->calculateBillDay();

        return $memPurchase->recurring_bill_day;
    }

    public function getPurchaseDateText()
    {
        if(empty($this->purchase_date))
            return null;

        return Yii::$app->formatter->asDate($this->purchase_date, 'MM/dd/yyyy');
    }

    public function getActiveDateText()
    {
        if(empty($this->active_date))
            return null;

        return Yii::$app->formatter->asDate($this->active_date, 'MM/dd/yyyy');
    }

    public function getRecurringDate($baseDate = null)
    {
        if(empty($this->recurring_bill_day) || (empty($baseDate) && empty($this->active_date)) )
            return null;

        if(empty($baseDate))
            $dt = $this->active_date;
        else
            $dt = $baseDate;

        if($this->initial_bill_day == $this->recurring_bill_day) {
            $dt = strtotime( '+1 month', $dt);
        }

        return $this->calculateDateFromDay($this->recurring_bill_day, $dt);
    }

    public function getInitialDate()
    {
        if(empty($this->initial_bill_day) || empty($this->active_date))
            return null;

        return $this->calculateDateFromDay($this->initial_bill_day, $this->active_date);
    }

    public function getInitialDateText()
    {
        $ts = $this->getInitialDate();

        if(empty($ts))
            return '';

        return Yii::$app->formatter->asDate($ts, 'MM/dd/yyyy');
    }

    public function getRecurringDateText($baseDate = null)
    {
        $ts = $this->getRecurringDate($baseDate);

        if(empty($ts))
            return '';

        return Yii::$app->formatter->asDate($ts, 'MM/dd/yyyy');
    }



    public static function purchaseMembership($membershipId, $memberId, $payment_id = null, $update_existing = true)
    {
        if(empty($memberId) || empty($membershipId))
            return null;

        $transaction = null;

        // check if purchase for this product exists
        if($update_existing) {
            $transaction = Yii::$app->db->beginTransaction();

            $existPurchase = Purchase::find()->where(['member_id' => $memberId, 'type' => Purchase::PURCHASE_TYPE_MEMBERSHIP])->all();

            foreach ($existPurchase as $p) {
                $p->status = Purchase::STATUS_SET_TERMINATED;
                if(!$p->save()) {
                    Yii::info('Error updating existing purchase');
                    $transaction->rollBack();
                    return null;
                }
            }
        }

        if(empty($payment_id)) {
            $payment = PaymentMethod::find()->where(['member_id' => $memberId, 'status' => PaymentMethod::STATUS_ACTIVE])->one();

            if(empty($payment)) {
                Yii::info('No payment methods on file!');
                if(!empty($transaction)){$transaction->rollBack();}
                return null;
            }

            $payment_id = $payment->id;
        }

        $purchase = new Purchase(['type' => self::PURCHASE_TYPE_MEMBERSHIP, 'membership_id' => $membershipId, 'member_id' => $memberId, 'payment_id' => $payment_id]);

        // calculate dates
        $today = date('Y-m-d');
        $purchase->purchase_date = strtotime($today);
        $purchase->active_date = strtotime( '+3 days', strtotime( $today ) );

        $purchase->initial_bill_day = $purchase->calculateBillDay();

        $purchase->recurring_bill_day = $purchase->initial_bill_day;

        if(empty($purchase) || !$purchase->save()) {
            Yii::info('Failed saving purchase!'.print_r($purchase->errors, true));
            if(!empty($transaction)){$transaction->rollBack();}
            return null;
        }

        if(!empty($transaction))  {
            $transaction->commit();
        }

        return $purchase;
    }

    public static function purchaseProduct($product_option_id, $memberId, $payment_id = null, $update_existing = false)
    {
        if(empty($memberId) || empty($product_option_id))
            return null;

        $member = Member::find()->where(['id' => $memberId])->with('agent')->one();

        $productOption = ProductOption::findOne($product_option_id);

        if(empty($member) || empty($productOption))
            return null;

        // check validity
        $product = $productOption->product;

        if(!$product->checkState($member->state_id))
            return null;

        // check agent
        $agent = $member->agent;

        if(!$agent->checkState($member->state_id)) {
            return null;
        }

        $transaction = null;

        if(empty($payment_id)) {
            $payment = PaymentMethod::find()->where(['member_id' => $memberId, 'status' => PaymentMethod::STATUS_ACTIVE])->one();

            if(empty($payment)) {
                Yii::info('No payment methods on file!');
                if(!empty($transaction)){$transaction->rollBack();}
                return null;
            }

            $payment_id = $payment->id;
        }

        // check if purchase for this product exists
        if($update_existing) {
            $transaction = Yii::$app->db->beginTransaction();

            $existPurchase = Purchase::find()->where(['member_id' => $memberId, 'type' => Purchase::PURCHASE_TYPE_PRODUCT])->andWhere(['in', 'product_option_id', $product->getProductOptions()->select('id')])->all();

            foreach ($existPurchase as $p) {
                $p->status = Purchase::STATUS_SET_TERMINATED;
                if(!$p->save()) {
                    Yii::info('Error updating existing purchase');
                    $transaction->rollBack();
                    return null;
                }
            }
        } else {
            $existPurchase = Purchase::find()->where(['member_id' => $memberId, 'type' => Purchase::PURCHASE_TYPE_PRODUCT])->andWhere(['in', 'product_option_id', $product->getProductOptions()->select('id')])->all();

            if(!empty($existPurchase)) {
                Yii::info('Trying to buy product twice!');
                if(!empty($transaction)) {$transaction->rollBack();}
                return null;
            }
        }

        $purchase = new Purchase(['member_id' => $member->id, 'type' => Purchase::PURCHASE_TYPE_PRODUCT, 'product_option_id' => $productOption->id, 'payment_id' => $payment_id]);

        // calculate dates
        $today = strtotime(date('Y-m-d'));
        $purchase->purchase_date = $today;
        $purchase->active_date = strtotime( '+3 days',$today );

        $purchase->initial_bill_day = $purchase->calculateBillDay();

        $purchase->recurring_bill_day = $purchase->calculateRecurringBillDay(); //$member->getRecurringBillDay();


        if(empty($purchase) || !$purchase->save()) {
            Yii::info('Error creating new purchase! - '.print_r($purchase->errors, true));
            if(!empty($transaction)) {$transaction->rollBack();}
            return null;
        }

        if(!empty($transaction)) {$transaction->commit();}

        return $purchase;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'payment_id'])->inverseOf('purchases');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id'])->inverseOf('purchases');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembership()
    {
        return $this->hasOne(Membership::className(), ['id' => 'membership_id'])->inverseOf('purchases');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOption()
    {
        return $this->hasOne(ProductOption::className(), ['id' => 'product_option_id'])->inverseOf('purchases');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        $prodOpt = $this->productOption;

        if(empty($prodOpt))
            return null;

        return $prodOpt->getProduct();
    }

    /**
     * @return integer
     */
    public function getExtId()
    {
        if($this->type == Purchase::PURCHASE_TYPE_MEMBERSHIP) {
            $obj = $this->membership;
        } elseif($this->type == Purchase::PURCHASE_TYPE_PRODUCT) {
            $obj = $this->productOption;
        }

        if(empty($obj))
            return null;

        return ArrayHelper::getValue($obj, 'ext_id', null);
    }

    /**
     * @inheritdoc
     * @return PurchaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PurchaseQuery(get_called_class());
    }
}
