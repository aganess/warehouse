<?php

namespace app\modules\warehouse\models;

use Yii;
use yii\base\Exception;
use yii\helpers\Url;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

trait BaseImageTrait
{
    public $file;

    protected $image_path = '/images/';
    protected $ampersand = '/';
    protected $thumbs = '/thumbs/';

    public function attributeLabels()
    {
        return [
            'file' => 'Картинка'
        ];
    }
    /**
     * @return string|void
     */
    public function getImageThumbs()
    {
        if ($this->img) {
            return env('FRONTEND_URL') . $this->image_path . str_replace(['{', '}', '%'], ['', '', ''], self::tableName()) . $this->thumbs . $this->img;
        }else {
            return env('FRONTEND_URL') .  '/bundle/assets/images/no-photo.svg';
        }
    }

    /**
     * @return string|void
     */
    public function getImage()
    {
        if ($this->img) {
            return env('FRONTEND_URL') . $this->image_path . str_replace(['{', '}', '%'], ['', '', ''], self::tableName()) . $this->ampersand . $this->img;
        } else {
            return env('FRONTEND_URL') .  '/bundle/assets/images/no-photo.svg';
        }
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        Yii::setAlias('@images', (dirname(__DIR__, 3) ) . '/web/images');

        if ($file = UploadedFile::getInstance($this, 'file')) {
            $table_name = str_replace(['{', '}', '%'], ['', '', ''], self::tableName());

            FileHelper::createDirectory(Yii::getAlias('@images') . $this->ampersand . $table_name);
            FileHelper::createDirectory(Yii::getAlias('@images') . $this->ampersand . $table_name . $this->thumbs);

            $dir = Yii::getAlias('@images') . $this->ampersand . $table_name . $this->ampersand;

//            if (!file_exists($dir . $this->img)) {
//                unlink($dir . $this->img);
//            }

            $this->img = Yii::$app->getSecurity()->generateRandomString(32) . '.' . $file->extension;
            $file->saveAs($dir . $this->img);

            $imag = Yii::$app->image->load($dir . $this->img);
            $imag->background('#fff', 0);
            $imag->resize(150, 150, Yii\image\drivers\Image::INVERSE);
            $imag->crop(150, 150);
            $imag->save($dir . $this->thumbs . $this->img);

        };

        return parent::beforeSave($insert);
    }

}