<?php

namespace app\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property string $isbn
 *
 * @property User $user
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'], 
            [['user_id'], 'integer'],
            [['time_new'], 'integer'],
            [['title'], 'string'],
            [['description'], 'string'],
            [['body'], 'string'],
            [['isbn'], 'string', 'max' => 32],
            [['img'], 'file'],
            [['user_id'], 'exist', 'targetClass'=>'\common\models\User', 'targetAttribute'=>'id', 'message'=>Yii::t('app','This user doesn\'t exist')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Tiêu đề bài viết'),
            'description' => Yii::t('app', 'Link Video nhúng'),
            'body' => Yii::t('app', 'Nội dung'),
            'user_id' => Yii::t('app', 'Tác giả'),
            'isbn' => Yii::t('app', 'Công khai'),
            'time_new' => Yii::t('app', 'Thời gian cập nhật'),
            'img' => Yii::t('app', 'Ảnh minh họa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getimageurl()
    {
       // return your image url here
       return \Yii::$app->request->BaseUrl.'/uploads/'.$this->img;
    }
    public function getlinkurl()
    {
        //thuc hien chon bai viet hien thi
        $actual_link = "/".$this->title_seo;
       
        return $actual_link;
    }
}
