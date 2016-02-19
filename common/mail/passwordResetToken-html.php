<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Xin chào <?= Html::encode($user->displayname).
        ' bạn có tài khoản là '
        .Html::encode($user->username) ?>,</p>

    <p>Bạn hãy click vào đường link phía dưới để thay đổi mật khẩu của bạn:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
