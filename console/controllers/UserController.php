<?php
namespace console\controllers;

use common\models\Member;
use common\models\Membership;
use common\models\Purchase;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

use common\models\User;

class UserController extends Controller
{
    public $defaultAction = 'test';

    public function actionTest()
    {
        echo 'All systems nominal...'.PHP_EOL;

        return Controller::EXIT_CODE_NORMAL;
    }
   
    public function actionPasswd($memberName,$pass)
    {
       $member = User::findByUsername($memberName);
       $member->setPassword($pass);
       $member->removePasswordResetToken();
       return $member->save(false);

    }

    public function actionInfo($memberName)
   {
 //    $member = User::findOne($memberNum);
    $member = User::findByUsername($memberName);
      
     print_r($member->attributes);
   }

   public function actionList() {

    $model =  User::getMembers(); 
//    $model->unsetAttributes(); // clear any default values
      print_r($model);
//     $this->render('admin', array(
//    'model' => $model,
//  ));
}

}
