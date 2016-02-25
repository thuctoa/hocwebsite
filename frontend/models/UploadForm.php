<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [
                ['imageFiles'], 
                'file', 
                'skipOnEmpty' => false, 
                'extensions' => 'zip,rar', 
                'maxFiles' => 4,
            ],
        ];
    }

    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/'.Yii::$app->user->id.'/' .time().$file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
    public function attributeLabels()
    {
        return [
            'imageFiles' => Yii::t('app', 'Chọn tệp tin nén định dạng zip hoặc rar của bạn'),
        ];
    }
}