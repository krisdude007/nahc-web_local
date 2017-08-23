<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "fed_ach".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $office_code
 * @property integer $routing
 * @property integer $new_routing
 * @property integer $frb
 * @property string $change_date
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $zip_ext
 * @property string $phone_area
 * @property string $phone_prefix
 * @property string $phone_suffix
 * @property string $status_code
 * @property string $view_code
 * @property string $filter
 * @property integer $created_at
 * @property integer $updated_at
 */
class FedAch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fed_ach';
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
            [['type', 'routing_num', 'new_routing_num', 'frb', 'created_at', 'updated_at'], 'integer'],
//            [['created_at', 'updated_at'], 'required'],
            [['name', 'address'], 'string', 'max' => 36],
            [['office_code', 'status_code', 'view_code'], 'string', 'max' => 1],
            [['change_date'], 'string', 'max' => 6],
            [['city'], 'string', 'max' => 20],
            [['state'], 'string', 'max' => 2],
            [['zip', 'filter'], 'string', 'max' => 5],
            [['zip_ext'], 'string', 'max' => 4],
            [['phone_area', 'phone_prefix', 'phone_suffix'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Customer Name',
            'type' => 'Record Type Code',
            'office_code' => 'Office Code',
            'routing_num' => 'Routing Number',
            'new_routing_num' => 'New Routing Number',
            'frb' => 'Servicing FRB Number',
            'change_date' => 'Change Date',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State Code',
            'zip' => 'Zipcode',
            'zip_ext' => 'Zipcode Extension',
            'phone_area' => 'Telephone Area Code',
            'phone_prefix' => 'Telephone Prefix Number',
            'phone_suffix' => 'Telephone Suffix Number',
            'status_code' => 'Institution Status Code',
            'view_code' => 'Data View Code',
            'filter' => 'Filler',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return FedAchQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FedAchQuery(get_called_class());
    }
}
