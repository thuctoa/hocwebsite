<?php
use yii\widgets\ActiveForm;
?>
<div class="upload text-center ">
    <hr>
    <b class="text-info">
    Gửi bài tập của học viên <span class="text-primary">
        <?php 
            if(!Yii::$app->user->isGuest){
                echo Yii::$app->user->identity->displayname;
            }
        ?>
    </span>
    </b>
    <hr>
<?php 

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) 
?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => '/*']) ?>

    <button ><b>Gửi cho ban quản trị</b></button>

<?php ActiveForm::end() ?>
    <hr>
</div>