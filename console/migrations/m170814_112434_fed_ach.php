<?php

use yii\db\Migration;

class m170814_112434_fed_ach extends Migration
{
//    public function safeUp()
//    {
//
//    }
//
//    public function safeDown()
//    {
//        echo "m170814_112434_fed_ach cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $ach = new console\controllers\SyncController('sync', Yii::$app);

        if(!file_exists(\Yii::getAlias('@runtime').'/cacert.pem')) {
            $ach->runAction('get-curl-pem');
        }

        if(!file_exists(\Yii::getAlias('@runtime').'/FedACHdir.txt')) {
            $ach->runAction('get-ach-file');
        }

        $ach->runAction('fed-ach');
    }

    public function down()
    {
        echo "m170814_112434_fed_ach cannot be reverted.\n";

        return false;
    }

}
