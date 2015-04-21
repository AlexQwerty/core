<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $setting_id
 * @property string $key
 * @property string $value
 */
class Settings extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['key', 'value'], 'required'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 50]
        ];
    }

    public function getId() {
        return $this->setting_id;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'setting_id' => 'Setting ID',
            'key' => 'Key (do not change the value!)',
            'value' => 'Value',
        ];
    }

}
