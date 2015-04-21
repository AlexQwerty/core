<?php

namespace app\controllers;

use yii\web\Controller;
use samalex\crud\controllers\actions;

class PagesController extends Controller {

    public $layout = 'admin';

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['all', 'view', 'update', 'create', 'delete'],
                'rules' => [
                    [
                        'actions' => ['all', 'view', 'update', 'create', 'delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return (!\yii::$app->user->isGuest && \yii::$app->user->identity->role_id === 9);
                        }
                    ],
                ],
            ]
        ];
    }

    public function actions() {
        return [
            'all' => ['class' => actions\ActionAll::className()],
            'view' => ['class' => actions\ActionView::className()],
            'update' => ['class' => actions\ActionUpdate::className(), 'view' => 'update', 'redirect' => 'all'],
            'create' => ['class' => actions\ActionCreate::className(), 'view' => 'create', 'redirect' => 'all'],
            'delete' => ['class' => actions\ActionDelete::className()],
        ];
    }

    public function actionIndex($token) {
        $this->layout = 'main';
        $page = \app\models\Pages::findOne(['token' => $token]);
        return $this->render('index', ['page' => $page]);
    }

}
