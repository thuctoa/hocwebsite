<?php
use kato\DropZone;
echo DropZone::widget([
       'options' => [
            'url'=>'/book/upload.html',
            'maxFilesize' => '20',
           'dictDefaultMessage'=>'Click vào đây để đưa ảnh lên Server',
       ],
       'clientEvents' => [
           'complete' => "function(file){console.log(file); location.reload();}",
           'removedfile' => "function(file){alert(file.name + ' đã được xóa')}"
       ],
   ]);
$files=\yii\helpers\FileHelper::findFiles('uploads');
?>
<div class="upanh">
    <?php
    foreach ($files as $val){
    ?>
        <a  href="/<?=$val?>">
            <img class="upanhcuthe" src="/<?=$val?>" width="100" height="100"/>
        </a>
    <?php
    }
    ?>
</div>