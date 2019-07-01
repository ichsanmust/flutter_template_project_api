<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\MobileSession;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ChangePassword extends Model {

    public $username;
    public $old_password;
    public $new_password;
    public $new_password_confirm;
    public $device_mobile_id;
    public $application_id;
    private $_user = false;

    public function rules() {
        return [
            [['username', 'old_password'], 'required'],
            ['old_password', 'validatePassword'],
            [['device_mobile_id', 'application_id'], 'required', 'on' => 'apiChangePasswordScenario'],
            
            [['new_password', 'new_password_confirm'], 'required'],
            [['new_password', 'new_password_confirm'], 'string', 'min' => 6],
            [['new_password_confirm'], 'compare', 'compareAttribute' => 'new_password'],	
        ];
    }

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, 'Incorrect old password.');
            }
        }
    }

    public function changePassword() {
        $user = $this->getUser();
        $user->setPassword($this->new_password);
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save(false);
        return $user;
    }

    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

}

?>
