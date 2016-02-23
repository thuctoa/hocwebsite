<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="description" content="Hướng dẫn lập trình học website mã nguồn mở PHP">
    <meta name="keywords" content="Học website, học lập trình php, thiết kế website, 
          khóa học lập trình php miễn phí">
    <meta name="author" content="Nguyễn Thế Thức">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="fb:app_id" content="213920512290093" />
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
    window.onresize = displayWindowSize;
    window.onload = displayWindowSize;

    function displayWindowSize() {
        myWidth = window.innerWidth;
        myHeight = window.innerHeight;
        // your size calculation code here

        document.getElementById("timkiem").style.cssText = "width: "+(myWidth-chieurongbandau)+'px;';

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
            $items = [
                   // ['label' => Yii::t('app','Trang chủ'), 'url' => ['/site/index']],
                    //['label' => Yii::t('app','Giới thiệu'), 'url' => ['/site/about']],
                    //['label' => Yii::t('app','Liên hệ'), 'url' => ['/site/contact']],
                    
                    Yii::$app->user->isGuest ?
                        ['label' => Yii::t('app','Đăng nhập'), 'url' => ['/site/login']] :
                        ['label' => Yii::t('app','Đăng xuất').' (' . Yii::$app->user->identity->displayname . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    Yii::$app->user->isGuest ?
                        ['label' => Yii::t('app','Tạo tài khoản'), 'url' => ['/site/signup']] :
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
                ];
            if ( Yii::$app->user->can('permission_monitor') ){
                $items[] = ['label' => Yii::t('app','Viết bài mới'), 'url' => ['/book/create']];
            }
            if ( Yii::$app->user->can('permission_admin') ){
                $items[] = ['label' => Yii::t('app','Phân quyền'), 'url' => ['/admin/admin/assignment']];
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
            <?= $content ?>
        </div>
        
    </div>
    <footer class="footer">
        <div class="container">
            <span id="chuyentoike">
                &copy; <?= \Yii::$app->name.' '.date('Y') ?>
            </span>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>