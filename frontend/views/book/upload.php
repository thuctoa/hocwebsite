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
    $files=\yii\helpers\FileHelper::findFiles('uploads');
?>
    <?php
    
    foreach ($files as $val){
        $val1=explode("/",$val);
            if(!isset($val1[2])){
                
    ?>
    <div class="book-anh">
        <p><?=$val1[1]?></p>
        <a  href="/<?=$val?>">
            <img class="upanhcuthe" src="/<?=$val?>" width="100" height="100"/>
        </a>
        <span class="glyphicon glyphicon-remove">
            
        </span>
        <a  href="/book/removeimg?val=<?=$val?>" onClick="return confirm('Bạn có muốn chắc xóa ảnh này không?')">
            Xóa ảnh này
        </a>
    </div>  
        
    <?php
            }
    }
    ?>
