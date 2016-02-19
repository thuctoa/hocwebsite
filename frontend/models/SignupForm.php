<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $phone_number;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['first_name', 'string', 'max' => 64],
            ['first_name', 'required'],
            
            ['last_name', 'string', 'max' => 64],
            ['last_name', 'required'],
            
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            
            ['phone_number', 'string', 'min' => 3, 'max'=>32],
            ['phone_number', 'required'],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('app', 'Họ'),
            'last_name' => Yii::t('app', 'Tên'),
            'username' => Yii::t('app', 'Tên tài khoản'),
            'email' => Yii::t('app', 'Địa chỉ Email'),
            'phone_number' => Yii::t('app', 'Số điện thoại'),
            'password' => Yii::t('app', 'Mật khẩu'),
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->first_name =  $this->first_name;
            $user->last_name = $this->last_name;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->phone_number = $this->phone_number;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
