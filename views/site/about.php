<?php
use yii\helpers\Html;


$this->title = 'About Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div style="white-space: pre-line;">
        <?=$settings['aboutus'];?>
    </div>
</div>
