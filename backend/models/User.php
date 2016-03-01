<?php

namespace app\models;
use common\seo\Urlseo;
use Yii;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone_number
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Book[] $books
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'username', 'auth_key', 'password_hash', 'email', 'phone_number', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 64],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key', 'phone_number'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['user_id' => 'id']);
    }
    public function getBaitap(){
        Yii::setAlias('@anyname', realpath(dirname(__FILE__).'/../../'));
        $dir = Yii::getAlias('@anyname').'/frontend/web/uploads/'.$this->id;
        
        if(file_exists($dir)){
            $files=\yii\helpers\FileHelper::findFiles($dir);
            if(!empty($files)){
                echo $dir;
                arsort($files);
                $mang=[];
                $mang1=[];
                foreach ($files as $key=>$val){
                   $val1=explode("/",$val);
                   if(isset($val1[8])){
                       $mang[]= $val1[8];
                       $val2=explode("^",$val1[8]);
                       $mang1[]=$val2[0];
                   }
                }
                $bt='';
                foreach ($mang as $key=>$val){
                    $bt=$bt.'<a href=/uploads/'.$this->id.'/'.$val.'>'.Urlseo::thoigian($mang1[$key]).'</a><hr>';
                }
                return $bt;
            }else{
                return 'Không có bài nào';
            }
        }else{
            return 'Chưa nộp bài lần nào';
        }
        
    }
}
