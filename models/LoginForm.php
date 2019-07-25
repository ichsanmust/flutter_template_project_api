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
class LoginForm extends Model {

    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;
    public $device_mobile_id;
    public $application_id;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            [['device_mobile_id', 'application_id'], 'required', 'on' => 'apiLoginScenario'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    public function apiLogin() {
        $user = $this->getUser();
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->save(false);
        $this->setSessionMobile($user);
        return $user;
    }

    private function setSessionMobile($user) {
        
        $this->deleteSessionMobile($user->id);
       
        $session = new MobileSession();
        $session->id_user = $user->id;
        $session->auth_key = $user->auth_key;
        $session->device_mobile_id = $this->device_mobile_id;
        $session->application_id = $this->application_id;
        $session->valid_date_time = $this->getValidDateLogin();
        $session->status = 1;
        $session->save(false);
    }
    
    private function deleteSessionMobile($id) {
        MobileSession::updateAll(['status' => 0], ['=', 'id_user', $id]);
    }
    
    private function getValidDateLogin() {
        $dateNow = date('Y-m-d H:i:s');
        $dayDiff = '+30';
        $valid_date_time = date('Y-m-d H:i:s', strtotime($dayDiff . ' days', strtotime($dateNow)));
        return $valid_date_time;
    }
    
    
    

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

}
