<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Xin chào <?= $user->displayname.' bạn có tài khoản là '.$user->username ?>,

Bạn hãy click vào đường link phía dưới để thay đổi mật khẩu:

<?= $resetLink ?>
