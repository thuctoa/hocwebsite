<?php
use yii\widgets\ActiveForm;
use common\seo\Urlseo;
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
<div class="list-life-upload">
    <?php
        $files=\yii\helpers\FileHelper::findFiles('uploads/'.Yii::$app->user->id);
        
        foreach ($files as $key=>$val){
            $val1=explode("/",$val);
            if(isset($val1[2])){
                $val2=explode("_",$val1[2]);
        ?>
        <div class="row book-tep">
            <div class="col-sm-1 tai-xoa text-primary">
                Tệp thứ <?=$key+1?>
            </div>
            <div class="col-sm-2">
                <img class="upanhcuthe" src="/uploads/anhzip.jpg" width="100" height="100"/>
            </div>
            <div class="col-sm-5">
                <div class="row tai-xoa">
                    <a  href="/<?=$val?>">
                        <span class="glyphicon glyphicon-download-alt"> <?=$val1[2]?></span>
                    </a>
                </div>
                <div class="row tai-xoa">
                    <a  href="/site/removeimg?val=<?=$val?>" onClick="return confirm('Bạn có muốn chắc xóa tệp tin này không?')">
                        <span class="glyphicon glyphicon-remove"> Xóa tệp tin này </span>
                    </a>
                </div>
            </div>
            <div class="col-sm-2 tai-xoa">
                <?php
                    echo Urlseo::thoigian($val2[0]);
                ?>
            </div>
        </div>  

        <?php
            }
        }
    ?>

    
</div>