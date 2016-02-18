<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
<!-- Your share button code -->
	<div class="fb-share-button" 
		data-layout="button_count">
	</div>
        <div class="fb-like" 
		data-layout="standard" 
		data-action="like" 
		data-show-faces="true">
	</div>
    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>
