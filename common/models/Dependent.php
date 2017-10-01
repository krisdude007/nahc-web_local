<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dependent".
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $relationship
 * @property string $f_name
 * @property string $l_name
 * @property string $m_name
 * @property string $dob
 * @property string $gender
 * @property string $ssn
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property integer $state_id
 * @property string $zip
 * @property string $email
 * @property string $phone
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Member $member
 * @property array  $relationshipTypes
 */
class Dependent extends \yii\db\ActiveRecord
{
    const RELATIONSHIP_SPOUSE = 1;
    const RELATIONSHIP_CHILD  = 2;

    private $_dobText;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dependent';
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
            [['member_id', 'relationship','f_name','l_name','gender','dob','dobText','ssn'], 'required'],

            [['member_id', 'relationship', 'state_id', 'status', 'created_at', 'updated_at'], 'integer'],

            ['relationship', 'unique', 'targetAttribute' => ['relationship', 'member_id'], 'when' => function($model) {
                return $model->relationship == self::RELATIONSHIP_SPOUSE;
            }, 'message' => 'Only one spouse dependent allowed per member'],

            [['dob'], 'date', 'format' => 'php:Y-m-d',
                'min' => \Yii::$app->formatter->asDate(strtotime( '-26 years', strtotime( date('Y-m-d') ) ),'php:Y-m-d'),
                'max' => \Yii::$app->formatter->asDate(strtotime(date('Y-m-d')),'php:Y-m-d'),
                'when' => function($model) {
                    return $model->relationship == self::RELATIONSHIP_CHILD;
                }
            ],
            [['dobText'], 'date', 'format' => 'short',
                'min' => \Yii::$app->formatter->asDate(strtotime( '-26 years', strtotime( date('m/d/Y') ) ), 'MM/dd/yyyy'),
                'max' => \Yii::$app->formatter->asDate(strtotime(date('m/d/Y')),'MM/dd/yyyy'),
                'when' => function($model) {
                    return $model->relationship == self::RELATIONSHIP_CHILD;
                }],

            [['dob'], 'date', 'format' => 'php:Y-m-d',
                'max' => \Yii::$app->formatter->asDate(strtotime( '-18 years', strtotime( date('Y-m-d') ) ), 'php:Y-m-d'),
                'when' => function($model) {
                    return $model->relationship == self::RELATIONSHIP_SPOUSE;
                }],
            [['dobText'], 'date', 'format' => 'short',
                'max' => \Yii::$app->formatter->asDate(strtotime( '-18 years', strtotime( date('m/d/Y') ) ), 'MM/dd/yyyy'),
                'when' => function($model) {
                    return $model->relationship == self::RELATIONSHIP_SPOUSE;
                }],

            [['relationship'], 'integer', 'min' => self::RELATIONSHIP_SPOUSE, 'max' => self::RELATIONSHIP_CHILD],


            [['f_name', 'l_name', 'm_name', 'address', 'address2', 'city', 'email'], 'string', 'max' => 255],
            [['gender'], 'match', 'pattern' => '/^[MF]{1}$/'],

            [['zip'], 'match', 'pattern' => '/^[0-9]{5}$/'],
            [['phone'], 'match', 'pattern' => '/^[0-9]{10}$/'],
            [['ssn'], 'match', 'pattern' => '/^[0-9]{9}$/'],

            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
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
            'relationship' => 'Relation To Member',
            'relationshipText' => 'Relation To Member',
            'nameText' => 'Name',
            'f_name' => 'First Name',
            'm_name' => 'Middle Name',
            'l_name' => 'Last Name',
            'dob' => 'Date of Birth',
            'dobText' => 'Date of Birth',
            'gender' => 'Gender',
            'ssn' => 'Social Security Number',
            'address' => 'Address',
            'address2' => 'Address 2',
            'city' => 'City',
            'state_id' => 'State',
            'state' => 'State',
            'zip' => 'Zip Code',
            'email' => 'Email Address',
            'phone' => 'Phone Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getRelationshipTypes()
    {
        return [
            self::RELATIONSHIP_SPOUSE => 'Spouse',
            self::RELATIONSHIP_CHILD => 'Child',
        ];
    }

    public function getRelationshipText()
    {
        switch($this->relationship) {
            case self::RELATIONSHIP_SPOUSE:
                return 'Spouse';
                break;
            case self::RELATIONSHIP_CHILD:
                return 'Child';
                break;
            default:
                return 'N/A';
                break;
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

    public function getDobText()
    {
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

    public function setDOBText($date)
    {
        try {
            $dob = \Yii::$app->formatter->asDate($date, 'php:Y-m-d');

            $this->dob = $dob;

            $this->_dobText = null;
        }
        catch (\Exception $e) {
            $this->_dobText = $date;
        }
    }

    public function getStateText()
    {
        return ArrayHelper::getValue($this->state, 'name', 'N/A');
    }

    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id'])->inverseOf('dependents');
    }

    /**
     * @inheritdoc
     * @return DependentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DependentQuery(get_called_class());
    }
}
