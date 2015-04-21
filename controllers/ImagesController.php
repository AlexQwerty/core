<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use samalex\crud\controllers\actions;

/**
 * CarImagesController implements the CRUD actions for CarImages model.
 */
class ImagesController extends Controller {

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
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
            Yii::$app->session->setFlash('danger', 'This section is only for registered users.');
            Yii::$app->user->loginRequired();
        }
            ]
        ];
    }

    public function actions() {
        return [
            'all' => ['class' => actions\ActionAll::className()],
//            'delete' => ['class' => actions\ActionView::className()],
            'create' => ['class' => actions\ActionCreate::className(), 'layout' => 'main', 'view' => 'create', 'redirect' => 'detail'],
            'update' => ['class' => actions\ActionUpdate::className(), 'redirect' => 'all'],
        ];
    }

    public function actionIndex() {
        $this->layout = 'main';
        $model = new \app\models\search\Images();
        if (Yii::$app->user->isGuest) {
            return $this->render('/images/index', ['dataProvider' => $model->search([])]);
        } else {
            $model->user_id = yii::$app->user->id;
            return $this->render('index', ['dataProvider' => $model->search([])]);
        }
    }

    public function actionDetail($id) {
        $this->layout = 'main';
        $model = \app\models\Images::findOne(['image_id' => $id]);
        return $this->render('view', ['model' => $model]);
    }

    public function actionView($key) {
        $this->layout = 'main';
        $model = \app\models\Images::getByKye($key);
        return $this->render('view', ['model' => $model]);
    }

    public function actionMy() {
        $this->layout = 'main';
        $model = new \app\models\search\Images();
        return $this->render('index', ['dataProvider' => $model->search(['Images' => ['user_id' => \yii::$app->user->id]])]);
    }

}
