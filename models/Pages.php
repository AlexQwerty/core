<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $page_id
 * @property string $token
 * @property string title
 * @property string $text
 */
class Pages extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['token', 'text'], 'required'],
            [['text', 'title'], 'string'],
            [['token', 'title'], 'string', 'max' => 45],
            [['token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'page_id' => 'Page ID',
            'token' => 'Token',
            'title' => 'Title',
            'text' => 'Text',
        ];
    }

    public function getId() {
        return $this->page_id;
    }

}
