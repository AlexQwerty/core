<?php

namespace app\models;

use yii\base\Model;
use app\models\Users;

class ForgotForm extends Model {

    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['email'], 'required'],
            ['email', 'email'],
            ['email', 'exist', 'targetAttribute' => 'email', 'targetClass' => Users::className()],
        ];
    }

}
