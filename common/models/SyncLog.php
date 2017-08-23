<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sync_log".
 *
 * @property integer $id
 * @property string $instance
 * @property integer $sync_type
 * @property integer $sync_begin
 * @property integer $sync_complete
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class SyncLog extends \yii\db\ActiveRecord
{
    const SYNC_TYPE_PURCHASE = 1;
    const SYNC_TYPE_MEMBER = 2;
    const SYNC_TYPE_AGENT = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sync_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sync_type', 'sync_begin', 'sync_complete', 'created_at', 'updated_at'], 'required'],
            [['sync_type', 'sync_begin', 'sync_complete', 'status', 'created_at', 'updated_at'], 'integer'],
            [['instance'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'instance' => 'Instance',
            'sync_type' => 'Sync Type',
            'sync_begin' => 'Sync Begin',
            'sync_complete' => 'Sync Complete',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findLastSync()
    {
        $sync = self::find()->orderBy('sync_at')->one();

        if(empty($sync))
            return null;

        return $sync;
    }

    public static function LogSync($start, $type = self::SYNC_TYPE_PURCHASE)
    {
        $sl = new SyncLog(['sync_type' => $type, 'sync_begin' => $start, 'sync_commplete' => time()]);

        if(!$sl->save())
            return false;

        return true;
    }

    /**
     * @inheritdoc
     * @return SyncLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SyncLogQuery(get_called_class());
    }
}
