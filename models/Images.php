<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $product_id
 * @property string $title
 * @property string $describe
 * @property double $price
 * @property integer $qnt
 * @property integer $user_id
 * @property string $image
 */
class Images extends \yii\db\ActiveRecord {

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['thumb', 'url'], 'required'],
            [['file'], 'file', 'extensions' => 'jpg, png, jpeg'],
            [['describe', 'key'], 'string'],
            [['user_id'], 'integer'],
            [['thumb', 'url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'image_id' => 'Image ID',
            'describe' => 'Describe',
            'url' => 'Url',
            'thumb' => 'Thumb',
            'user_id' => 'user_id',
            'file' => 'Picture',
            'key' => 'Key',
        ];
    }

    public function getImagePath($thumb = false) {
        $attribute = ($thumb) ? $this->thumb : $this->url;
        return isset($attribute) ? Yii::getAlias('@webroot/img/pic/') . $attribute : null;
    }

    public function getImageUrl($thumb = false) {
        $attribute = ($thumb) ? $this->thumb : $this->url;
        $image = !empty($attribute) ? $attribute : 'default.jpg';
        return Yii::getAlias('@web/img/pic/') . $attribute;
    }

    public function getId() {
        return $this->image_id;
    }

    public function beforeValidate() {
        if (empty($this->user_id)) {
            $this->user_id = \yii::$app->user->id;
        }
        $this->key = Yii::$app->security->generateRandomString(13);
        if ($this->uploadImage()) {
            return parent::beforeValidate();
        }
        return false;
    }

    /**
     * Process upload of image
     *
     * @return mixed the uploaded image instance
     */
    public function uploadImage() {
        $file = \yii\web\UploadedFile::getInstance($this, 'file');
        if (empty($file)) {
            return true;
        }
        $ext = end((explode(".", $file->name)));
        $this->url = Yii::$app->security->generateRandomString() . ".{$ext}";
        $this->thumb = '_' . $this->url;
        if ($file->saveAs($this->imagePath)) {
            $image = Yii::$app->image->load($this->imagePath);
            $image->resize(1100, 700, Yii\image\drivers\Image::WIDTH)
                    ->save();
            $size = min($image->width, $image->height);
            $image->crop($size, $size)->resize(300, 300)->save($this->getImagePath(true));
            return true;
        } else {
            $this->addError('file', 'Error to add image');
            return false;
        }
    }

    static public function getByKye($key) {
        return self::findBySql('SELECT * FROM `images` where BINARY `images`.`key` like :key', [':key' => $key])->one();
    }

}
