<?php 
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php 
    $this->beginPage() 
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="robots" content="noindex, nofollow, noodp, noydir" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="google-site-verification" content="sw1f1qIH5NbeJeIBhO7KfjoVtl0eUEExLmHUYGFakhE" />
    <meta name="p:domain_verify" content="949a682ec68ca427fee6248382a00e08"/>
    <meta name="msvalidate.01" content="B693FEE86D66E8587C4E1AA37056D47E" />
    <meta name="description" content="Hướng dẫn lập trình học website mã nguồn mở PHP cho người mới bắt đầu.">
    <meta name="keywords" content="Học website, học lập trình php, thiết kế website, 
          khóa học lập trình php miễn phí, Học lập trình website cho người mới bắt đầu học">
    <meta name="author" content="Nguyễn Thế Thức">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="fb:app_id" content="213920512290093" />
    <?php
        if(!empty(\Yii::$app->params['baiviet'])){
    ?>
            <meta property="og:image" content="http://hocwebsite.org/uploads/<?=\Yii::$app->params['baiviet']['img']?>" />
            <meta property="og:image:width" content="400" />
            <meta property="og:image:height" content="300" />
            <meta property="og:description" content="<?=\Yii::$app->params['baiviet']['description']?>" />
    <?php  
        }
    ?>
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>   
<div id="fb-root"></div>
<script>
    
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-73984606-1', 'auto');
    ga('send', 'pageview');
    
    
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

    var chieurongbandau = 700;
    var cachtrai=15;
    var ronganh=196;
    var cachhaiben=30;
    var dorong = ronganh + cachtrai;
    var dothem= cachhaiben*2 - cachtrai;
    var rongtrangchu=[];
    rongtrangchu[1]= dorong + dothem;
    rongtrangchu[2]= dorong*2 + dothem;
    rongtrangchu[3]= dorong*3 + dothem;
    rongtrangchu[4]= dorong*4 + dothem;
    rongtrangchu[5]= dorong*5 + dothem;
    rongtrangchu[6]= dorong*6 + dothem;
    rongtrangchu[7]= dorong*7 + dothem;
    rongtrangchu[8]= dorong*8 + dothem;
    rongtrangchu[9]= dorong*9 + dothem;
    rongtrangchu[10]= dorong*10 + dothem;
    
    window.onresize = displayWindowSize;
    window.onload = displayWindowSize;

    function displayWindowSize() {
        
        myWidth = window.innerWidth;
        myHeight = window.innerHeight;
        
        // your size calculation code here
        document.getElementById("timkiem").style.cssText = "width: "+(myWidth-chieurongbandau)+'px;';
        if(document.getElementById("trangchu")){
            
            if(myWidth>=rongtrangchu[10]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[10]+"px;";
            }else if(myWidth>=rongtrangchu[9]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[9]+"px;";
            }else if(myWidth>=rongtrangchu[8]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[8]+"px;";
            }else if(myWidth>=rongtrangchu[7]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[7]+"px;";
            }else if(myWidth>=rongtrangchu[6]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[6]+"px;";
            }
            else if(myWidth >=1024){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[5]+"px;";
            }else if(myWidth>=rongtrangchu[4]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[4]+"px;";
            }else if(myWidth>=rongtrangchu[3]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[3]+"px;";
            }else if(myWidth>=rongtrangchu[2]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[2]+"px;";
            }else if(myWidth<rongtrangchu[2]){
                document.getElementById("trangchu").style.cssText = 
                        "width: "+rongtrangchu[2]+"px;";
            }
        }
    };
    
</script>

<?php $this->beginBody() ?>
    <div class="wrap">
        
        <?php
            NavBar::begin([
                'brandLabel' => Html::img('/img/logo-nav.png',['alt'=>'Học Website']),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top menu ',
                ],
                
            ]);
            $valsreach="";
            if(isset($_GET['BookSearch'])){
                $valsreach=$_GET['BookSearch']['title'];
            }
            echo '<form class="navbar-form navbar-left" role="search"  action="/" method="get" >
                    <div class="input-group stylish-input-group" id="timkiem">
                        <input 
                            type="text"
                            class="form-control" 
                            placeholder="Tìm kiếm bài viết ..."
                            name="BookSearch[title]"
                            value="'.$valsreach.'"
                        >
                        <span class="input-group-addon"">
                            <button type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>  
                        </span>
                    </div>
                </form>';
            $items = [];
            if(Yii::$app->user->isGuest){
                $items  =   [
                                ['label' => Yii::t('app','Đăng nhập'), 'url' => ['/site/login']],
                                ['label' => Yii::t('app','Tạo tài khoản'), 'url' => ['/site/signup']],
                            ];
            }else{
                $items  =   [
                        ['label' => Yii::t('app','Gửi bài tập'), 'url' => ['/site/upload']],
                        [
                            'label' => Yii::t('app','Thông tin cá nhân'),
                                'items' => [
                                    ['label' => Yii::t('app','Xem hồ sơ'),'url'=>['/site/user']],
                                    '<li class="divider"></li>',
                                    '<li class="dropdown-header">Họ và tên, Email, số điện thoại</li>',
                                    ['label' => Yii::t('app','Đổi thông tin'), 'url' => '/site/update-user'],
                                    ['label' => Yii::t('app','Đổi mật khẩu'),'url'=>['/site/request-password-reset']],
                                ],

                        ], 
                        ['label' => Yii::t('app','Đăng xuất').' (' . Yii::$app->user->identity->displayname . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ];
            }
            if ( Yii::$app->user->can('permission_monitor') ){
                 $items[] = [
                                'label' => Yii::t('app','Tác vụ'),
                                    'items' => [
                                        ['label' => Yii::t('app','Viết bài mới'), 'url' => ['/book/create']],
                                        ['label' => Yii::t('app','Uploads ảnh'), 'url' => '/book/upload'],
                                        '<li class="divider"></li>',
                                        '<li class="dropdown-header">Phân quyền người dùng</li>',
                                        ['label' => Yii::t('app','Phân quyền'),'url'=>['/admin/admin/assignment']],
                                    ],
                            ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,
            ]);
            NavBar::end();
        ?>
        <div class="content" id="content">
            <?php 
                echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]); 
            ?>
            <div class="success-flash">
                <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
                <?php
                echo \kartik\widgets\Growl::widget([
                    'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                    'title' => (!empty($message['title'])) ? Html::encode($message['title']) :Yii::$app->session->getFlash('success'),
                    'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                    'body' => (!empty($message['message'])) ? Html::encode($message['message']) : Yii::$app->session->getFlash('success'),
                    'showSeparator' => true,
                    'delay' => 1, //This delay is how long before the message shows
                    'pluginOptions' => [
                        'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                        'placement' => [
                            'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                            'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                        ]
                    ]
                ]);
                ?>
                <?php endforeach; ?>
            </div>
            <?= $content ?>
            
        </div>
        
    </div>
    <footer class="footer">
        <div class="container">
            <span >
                <h3 class="hocwebsite"> &copy; <?= \Yii::$app->name.' '.date('Y') ?> </h3>
            </span>
            <div class="microformats">
                <ul class="vcard">
                    <li class="fn">Nguyễn Thế Thức </li>
                    <li class="org">Cẩm Nang Toán </li>
                    <li class="tel">0979-846-286</li>
                    <li><a class="url" href="http://hocwebsite.org/">http://hocwebsite.org/</a></li>
              </ul>
            </div>
            
            <span class="tacgia">
                <h3 class="hocwebsite">
                Phát triển bởi: 
            <a href='https://plus.google.com/117365335820918436212?rel=author' rel='author'>
                Nguyễn Thế Thức
            </a>  
                </h3>
            </span>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
