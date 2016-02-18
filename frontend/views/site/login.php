<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Bạn hãy điền đẩy đủ thông tin yêu cầu để đăng nhập</p>
    <div class="dangnhap">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
        ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->checkbox() ?>

        <div style="color:#999;margin:1em 0">
            Nếu bạn quên mật khẩu bạn có thể <?= Html::a('thay đổi nó', ['site/request-password-reset']) ?>.
        </div>

        <div class="form-group">
            <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            <?php
//                $facebook= AuthChoice::begin([
//                    'baseAuthUrl' => ['site/auth'],
//                    //'popupMode' => false,
//                ]);
//                foreach ($facebook->getClients() as $client){
//                    $facebook->clientLink($client,Html::tag('span', '', ['class' => 'auth-icon ' . $client->getName()]));
//                    break;
//                }
//                AuthChoice::end();
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

