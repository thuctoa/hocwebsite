<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use common\seo\Urlseo;
$this->title = Yii::t('app','Học Website');

?>
<div class="row site-index">
    <?php 
    if(!empty($baiviet)){
        $id=$baiviet['id'];
        $this->title = $baiviet['title'];
    ?>
        <div class="col-md-8">
            <div class="noidung"> 
                <div class="modau">
                    <?=$baiviet['description']?>
                    <meta name="keywords" content="<?=$baiviet['title']?>">
                    <meta name="description" content="<?=$baiviet['body']?>">
                </div>
                <div class=" tieude-chinh">
                    <h1>
                        <?=$baiviet['title']?>
                        
                    </h1>
                    <img src="/img/logo-nav.png" alt="<?=$baiviet['title']?>" />
                    <hr>
                </div>
                
                <div class="noidung-chinh">
                    <p>
                        <?=$baiviet['body']?>
                    </p>
                    <hr>
                </div>
                <div class="binhluan">
                    <div 
                            class="fb-comments "
                            data-numposts="5"
                            width="100%"
                            data-order-by="reverse_time"
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="bantin">
                <?php
                    function myUrlEncode($string) {
                        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23');
                        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#");
                        return str_replace($entities, $replacements, urlencode($string));
                    }
                ?>
                
                <?php if(isset($baiviet)){
                ?>
                <div class="row tin-dau">
                    <div class="col-sm-4">
                        <img src="../uploads/<?=$baiviet['img']?>" alt="<?=$baiviet['title']?>" class="anhminhhoa">
                    </div>
                    <div class="col-sm-8 tin-phai">
                        <p class="tieude-tin">
                        <?=$baiviet['title']?>
                        </p>
                        <p class="thoigian">
                            <?= Urlseo::thoigian($baiviet['time_new'])?>
                        </p>
                        <?php
                            if(Yii::$app->user->can('permission_monitor')){
                        ?>
                        <a href="/book/update?id=<?=$baiviet['id']?>">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <?php
                        }?>
                    </div>
                    
                </div>
                <?php
                }?>
                
                <hr>
                <?php
                foreach ($models as $model) {
                    if($id!=$model['id']){
                ?>
                    <a href="<?=$model->getlinkurl()?>">
                        <div class="row tin">
                            <div class="col-sm-4">
                                <img src="../uploads/<?=$model['img']?>" alt="<?=$model['title']?>" class="anhminhhoa">
                            </div>
                            <div class="col-sm-8 tin-phai">
                                <p class="tieude-tin"><?=$model['title']?></p>
                                <p class="thoigian">
                                    <?= Urlseo::thoigian($model['time_new'])?>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php
                    }
                }
                // display pagination
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>
    <?php
    }else if(isset($_GET['BookSearch'])){
    ?>
    <div class="trangchu" id="trangchu"> 
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout'=>"{summary}\n{items}\n{pager}",
            'tableOptions' =>['class' => 'table'],
            'columns' => [
                [
                    'value' => function($data) {
                        $url = $data->linkurl;
                        return Html::a(Html::img($data->imageurl,['width'=>200,'height'=>110,'alt'=>$data->title]),
                                $url, [
                                    'title' => 'Xem bài viết',
                                    
                                    ] );
                    },
                    'format' => 'raw',
                    'contentOptions'=>['style'=>'width: 220px;'], 
                ],
                [
                    'format'=>'raw',
                    'value' => function($data){
                        $url = $data->linkurl;
                        return Html::a(
                                '<p class="tieude-tin-trangchu">'.$data->title.'</p>'.
                                '<p class="thoigian">'.
                                Urlseo::thoigian($data->time_new)
                                .
                                '</p>',
                                $url, ['title' => 'Xem bài viết']
                                ); 
                    },
                    'contentOptions'=>['style'=>'text-align: left;'], 
                ],
            ],
        ]); ?>
    </div>
    <?php 
    }else {
    ?>
            <div class="trangchu" id="trangchu"> 
               <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout'=>"{items}\n{pager}",
                'tableOptions' =>['class' => 'table table-trangchu'],
                'columns' => [
                    [
                        'value' => function($data) {
                            $url = $data->linkurl;
                            return 
                                    Html::a('<p class="nenanhminhhoa">'.
                                            Html::img($data->imageurl
                                                    ,['width'=>160,'height'=>110,'alt'=>$data->title]).'</p>',
                                    $url, ['title' => 'Xem bài viết'] ).
                                    Html::a(
                                    '<p class="tieude-tin-trangchu">'.$data->title.'</p>'.
                                    '<p class="thoigian">'.
                                    Urlseo::thoigian($data->time_new)
                                    .
                                    '</p>',
                                    $url, ['title' => 'Xem bài viết']
                                    );
                            },
                        'format' => 'raw',
                        'contentOptions'=>['style'=>'width: 160px;'], 
                    ],
                ],
            ]); ?>
            </div>
    <?php
        }?>
</div>

