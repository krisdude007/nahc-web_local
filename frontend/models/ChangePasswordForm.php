<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    public $new_password;
    public $repeat_password;
    public $password;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_password', 'password', 'repeat_password'], 'required'],
            [['new_password', 'password', 'repeat_password'], 'string', 'min' => 6, 'max' => 255],
            [['repeat_password'], 'compare', 'compareAttribute'=>'new_password', 'message'=>"New passwords must match"]
        ];
    }

    /**
     * Changes password
     *
     * @return bool if password was reset.
     */
    public function changePassword()
    {
        $user = User::findOne(\Yii::$app->user->id);

        if(!$user->validatePassword($this->password)) {
            $this->addError('password', 'Incorrect current password.');
            return false;
        }

        $user->setPassword($this->new_password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
