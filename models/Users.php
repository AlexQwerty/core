<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property integer $role_id
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface {

    public $rememberMe, $password_repeat, $oldPassword, $newPassword, $newPassword_repeat;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['password', 'email'], 'required', 'on' => ['login', 'insert']],
            [['email'], 'unique', 'targetAttribute' => 'email', 'on' => ['insert']],
            [['email'], 'email', 'skipOnEmpty' => true],
            [['role_id', 'status'], 'integer'],
            ['password', 'compare', 'on' => ['insert']],
            ['password', 'string', 'min' => 6, 'on' => ['insert']],
            ['newPassword', 'compare', 'on' => ['edit']],
            [['oldPassword', 'newPassword', 'newPassword_repeat'], 'string', 'min' => 6, 'on' => ['edit']],
            [['password', 'password_repeat', 'email', 'access_token', 'auth_key', 'activate_key', 'reset_password_key'], 'string', 'max' => 255]
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['insert'] = ['email', 'password', 'password_repeat'];
        $scenarios['edit'] = ['oldPassword', 'newPassword', 'newPassword_repeat'];
        $scenarios['login'] = ['email', 'password'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'password' => Yii::t('app', 'Password'),
            'role_id' => Yii::t('app', 'Role ID'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public function getId() {
        return $this->user_id;
    }

    public static function findIdentity($id) {
        return static::findOne(['user_id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByActivateKey($key) {
        return self::findBySql("select * from users where BINARY activate_key = :key", [':key' => $key])->one();
    }
    
    public static function findByResetPasswordKey($key) {
        return self::findBySql("select * from users where BINARY reset_password_key = :key", [':key' => $key])->one();
    }

    public function setPassword($password) {
        $this->password = yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password) {
        return \yii::$app->security->validatePassword($password, $this->password);
    }

    public function login() {
        if ($this->validate()) {
            $user = Users::findOne(['email' => $this->email]);
            if ($user == null || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Incorrect email or password!');
            } else {
                if ($user->status == Users::STATUS_NOT_ACTIVE) {
                    $this->addError('email', 'Your account has not been activated!');
                } else if ($user->status == Users::STATUS_BANNED) {
                    $this->addError('email', 'Your account has been banned!');
                } else if ($user->status == Users::STATUS_ACTIVE) {
                    return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                }
            }
        }
        return false;
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
                $this->activate_key = Yii::$app->getSecurity()->generateRandomString(40);
                $this->setPassword($this->password);
            }
            return true;
        }
        return false;
    }

    public function generateResetPasswordKey(){
        $this->reset_password_key = Yii::$app->getSecurity()->generateRandomString();
        return $this;
    }
}
