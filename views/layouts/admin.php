<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

use app\assets\AppAsset;

$homeUrl = Yii::$app->homeUrl;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'brandLabel' => 'SBS',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-default navbar-static-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                Yii::$app->user->isGuest ? ['label' => 'Login', 'url' => ['/users/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->email . ')',
                    'url' => ['/users/logout'],
                    'linkOptions' => ['data-method' => 'post']
                        ],
            ],
        ]);
        NavBar::end();
        ?>
        <div class="col-lg-2">
            <ul class="list-group" style="margin-top: 20px">
                <li class="list-group-item"><a href="<?=$homeUrl;?>users/all">Users</a></li>   
                <li class="list-group-item"><a href="<?=$homeUrl;?>products/all">Products</a></li>   
                <li class="list-group-item"><a href="<?=$homeUrl;?>pages/all">Pages</a></li>   
            </ul>
        </div>
        <div class="col-lg-10">
            <?= $content ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
