<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

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
        <div  style="min-height: 100%;height: auto !important;height: 100%;margin: 0 auto -60px;">
            <?php $this->beginBody() ?>
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-default navbar-static-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    (!\yii::$app->user->isGuest && \yii::$app->user->identity->role_id === 9) ? ['label' => 'Admin', 'url' => '/pages/all'] : '',
                    Yii::$app->user->isGuest ?
                            '' :
                            [
                        'label' => Yii::$app->user->identity->email,
                        'url' => ['/users/account']
                            ],
                    Yii::$app->user->isGuest ? ['label' => 'Login', 'url' => '/login'] : ['label' => 'Log out', 'url' => '/logout', 'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
            ?>
            <div class="container">
                <?php
                foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                    echo '<div class="alert alert-' . $key . ' text-center">' . $message . '</div>';
                }
                ?>
                <div class="row">
                    <?= $content ?>
                </div>
            </div>
            <div style="height:80px"></div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="pull-left">
                    <p class="text-muted">&copy; 2015 <?= Yii::$app->name; ?></p>
                </div>
                <div class="pull-right">
                    <a href="/page/about">About</a>
                    <a href="/page/contact">Contact</a>
                </div>
            </div>
        </footer>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
