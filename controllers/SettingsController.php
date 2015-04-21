<?php

namespace app\controllers;

use yii\web\Controller;
use samalex\crud\controllers\actions;
/**
 * CarImagesController implements the CRUD actions for CarImages model.
 */
class SettingsController extends Controller {

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
                ],
            ]
        ];
    }

    public function actions() {
        return [
            'all' => ['class' => actions\ActionAll::className(), 'view' => 'all'],
            'update' => ['class' => actions\ActionUpdate::className(), 'view' => 'update', 'redirect' => 'all'],
        ];
    }

}
