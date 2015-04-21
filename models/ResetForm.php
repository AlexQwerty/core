<?php

namespace app\models;

use yii\base\Model;

class ResetForm extends Model {

    public $newPassword, $newPassword_repeat;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['newPassword', 'newPassword_repeat'], 'required'],
            ['newPassword', 'compare'],
            [['newPassword', 'newPassword_repeat'], 'string', 'min' => 6],
        ];
    }

}
