<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Đăng ký tài khoản';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Hãy điền đẩy đủ vào các trường sau để đăng ký tài khoản mới:</p>

    <div class="row ">
        <div class="col-lg-offset-4 col-lg-4">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-lg-offset-0 col-lg-6">
                    <?= $form->field($model, 'first_name') ?>
                </div>
                <div class="col-lg-offset-0 col-lg-6">
                    <?= $form->field($model, 'last_name') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-0 col-lg-6">
                    <?= $form->field($model, 'username') ?>
                </div>
                <div class="col-lg-offset-0 col-lg-6">    
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-0 col-lg-6">
                    <?= $form->field($model, 'phone_number') ?>
                </div>
                <div class="col-lg-offset-0 col-lg-6">    
                    <?= $form->field($model, 'email') ?>
                </div>
            </div>
                

            <div class="form-group">
                <div class="dangkytaikhoan">
                <?= Html::submitButton('Đăng ký tài khoản', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
               
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
