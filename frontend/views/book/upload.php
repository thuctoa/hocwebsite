<?php

echo \kato\DropZone::widget([
       'options' => [
            'url'=>'/book/upload',
            'maxFilesize' => '20',
            'dictDefaultMessage'=>'Click vào đây để đưa ảnh lên Server',
            'acceptedFiles' => 'image/jpg, image/jpeg, image/png, image/gif',
       ],
       'clientEvents' => [
           'complete' => "function(file){console.log(file);location.reload();}",
           'removedfile' => "function(file){alert(file.name + ' đã được xóa')}"
       ],
   ]);

?>
<div class="upanh">
    <?php
    $files=\yii\helpers\FileHelper::findFiles('uploads');
    foreach ($files as $val){
    ?>
    <div class="book-anh">
        <a  href="/<?=$val?>">
            <img class="upanhcuthe" src="/<?=$val?>" width="100" height="100"/>
        </a>
        <span class="glyphicon glyphicon-remove">
            <a  href="/book/removeimg?val=<?=$val?>">
                Xóa ảnh 
            </a>
        </span>
    </div>  
        
    <?php
    }
    ?>
</div>
