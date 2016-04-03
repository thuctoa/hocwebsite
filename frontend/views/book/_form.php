<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use skeeks\yii2\ckeditor\CKEditorWidget;
use skeeks\yii2\ckeditor\CKEditorPresets;
/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 

    ?>
    
    <?php
        
        if ( Yii::$app->user->can('permission_monitor') 
            ||  Yii::$app->user->can('permission_admin')){
            
            echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->select(['username','first_name','last_name','id'])->all(), 'id', 'displayname'),['class' => 'form-control inline-block']); 
            echo $form->field($model, 'isbn')->dropDownList(['2' => 'PROTECTED', '1' => 'YES','0'=>'NO']);

        }
        else {
            echo $form->field($model, 'isbn')->textInput(['maxlength' => 32,'type'=>'hidden'])->label(FALSE);
            echo $form->field($model, 'user_id')->textInput(['value'=>\Yii::$app->user->id,'type'=>'hidden'])->label(FALSE);
        }
    ?>
    
    <?= $form->field($model, 'title')->textInput() ?>
    <?php
        if($model->img){
    ?>
            <img src="../uploads/<?=$model->img?>" width="20%">
    <?php
        }
    ?>
    <?= $form->field($model, 'numpost')->textInput() ?>
            
    <?= $form->field($model, 'img')->fileInput() ?>
            
    <?= $form->field($model, 'video')->textInput() ?> 
            
    <?= $form->field($model, 'description')->textInput() ?>
            
    <?= $form->field($model, 'body')->widget(CKEditorWidget::className(), [
        'options' => ['rows' => 6],
        'preset' => CKEditorPresets::FULL
    ]) ?>
   
    
    <?= $form->field($model, 'time_new')->textInput(['value'=>time(),'type'=>'hidden'])->label(FALSE) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tạo mới') : Yii::t('app', 'Chỉnh sửa xong'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
