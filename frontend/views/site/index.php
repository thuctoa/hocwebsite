<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use common\seo\Urlseo;
$this->title = Yii::t('app',\Yii::$app->name);

?>

<div class="row site-index">
    <?php
                //so bai viet
                if(isset($numpost)){
                        Yii::$app->params['numpost'] = $numpost;
                    }
                ?>
    <?php 
    if(!empty($baiviet)){
        //share facebook meta image
        \Yii::$app->params['baiviet']=$baiviet;
        //xac dinh vi tri bai viet
        \Yii::$app->params['viewpost']=$baiviet['numpost'];
        $id=$baiviet['id'];
        $this->title = $baiviet['title'];
    ?>
    <div id="fb-root"></div>
    <script>
         window.fbAsyncInit = function() {
        FB.init({
          appId      : '213920512290093',
          xfbml      : true,
          version    : 'v2.5'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/vi_VN/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));

    </script>
        <div class="col-md-8">
            <div class="noidung"> 
                <div class="modau">
                    <?=$baiviet['video']?>
                    <meta name="keywords" content="<?=$baiviet['title']?>">
                    <meta name="description" content="<?=$baiviet['description']?>">
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
                        <img title="<?=$baiviet['title']?>" src="../uploads/<?=$baiviet['img']?>" alt="<?=$baiviet['title']?>" class="anhminhhoa">
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
                        <a href="/book/update?id=<?=$baiviet['id']?>" title="<?=$baiviet['title']?>">
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
                <a href="<?=$model->getlinkurl()?>" title="<?=$model['title']?>">
                        <div class="row tin">
                            <div class="col-sm-4 nenanhminhhoa">
                                <img title="<?=$model['title']?>" src="../uploads/<?=$model['img']?>" alt="<?=$model['title']?>" class="anhminhhoa">
                            </div>
                            <div class="col-sm-8 tin-phai">
                                <p class=" tieude-tin-trangchu"><?=$model['title']?></p>
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
                        return Html::a(Html::img($data->imageurl,['title'=>$data->title,'width'=>200,'height'=>110,'alt'=>$data->title]),
                                $url, [
                                    'title' => $data->title,
                                    
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
                                $url, ['title' => $data->title]
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
                
                <div class="nentrang">
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
                                                        ,['width'=>196,'height'=>110,'alt'=>$data->title, 'title'=>$data->title]).'</p>',
                                        $url, ['title' => $data->title] ).
                                        Html::a(
                                        '<p class="tieude-tin-trangchu">'.$data->title.'</p>'.
                                        '<p class="thoigian">'.
                                        Urlseo::thoigian($data->time_new)
                                        .
                                        '</p>',
                                        $url, ['title' => $data->title]
                                        );
                                },
                            'format' => 'raw',
                            'contentOptions'=>['style'=>'width: 196px;'], 
                         ],
                     ],
                    ]); ?>
                </div>
                <table class="banner">
                    <tr>
                        <th rowspan="3" class="logo">
                            <img src="/favicon.ico" width="100" height="96" alt="<?=$this->title?>"/>
                            <h1 class="theh1"> <?=\Yii::$app->name?></h1>
                        </th>
                        <td>
                            <h2 class="theh2"> 
                                Chỉ với ba tháng với khóa học lập trình bằng ngôn ngữ PHP miễn phí
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="theh2"> 
                                Người học sẽ có được các kiến thức cơ bản về lập trình Website về SEO và bảo mật
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="theh2"> 
                                Từ cài đặt phần mềm lập trình đến học Framework và thực hành triển khai một hệ thống trên thực tế
                            </h2>
                        </td>
                    </tr>
                </table>
                
            </div>
    <?php
        }?>
</div>

