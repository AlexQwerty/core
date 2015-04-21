<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use samalex\crud\controllers\actions;

class UsersController extends \yii\web\Controller {

    public function actions() {
        return [
            'all' => ['class' => actions\ActionAll::className()],
            'view' => ['class' => actions\ActionView::className()],
            'update' => ['class' => actions\ActionUpdate::className()],
            'create' => ['class' => actions\ActionCreate::className()],
            'delete' => ['class' => actions\ActionDelete::className()],
        ];
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['all', 'view', 'update', 'create', 'delete', 'login', 'logout'],
                'rules' => [
                    [
                        'actions' => ['all', 'view', 'update', 'create', 'delete', 'logout', 'account'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin() {
        $model = new Users(['scenario' => 'login']);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(yii::$app->request->referrer);
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        $this->redirect(yii::$app->request->referrer);
    }

    public function actionRegistration() {
        $model = new Users(['scenario' => 'insert']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            yii::$app->mailer->compose('/email/activation', ['user' => $model])
                    ->setFrom('sbs@samrov.com')
                    ->setTo($model->email)
                    ->setSubject('Account activation')
                    ->send();
            yii::$app->session->setFlash('success', 'Your account successfully created, check your email for activation');
            return $this->goHome();
        }

        return $this->render('registration', [
                    'model' => $model,
        ]);
    }

    public function actionAccount() {
        return $this->render("account");
    }

    public function actionActivate($key) {
        $model = Users::findByActivateKey($key);
        if ($model == null) {
            yii::$app->session->setFlash('danger', 'Incorect key');
        } else {
            if ($model->status == Users::STATUS_ACTIVE) {
                yii::$app->session->setFlash('success', 'Your account is already activated');
            } else if ($model->status == Users::STATUS_NOT_ACTIVE) {
                $model->status = Users::STATUS_ACTIVE;
                $model->save();
                yii::$app->session->setFlash('success', 'Your account successfully activated');
            }
        }
        return $this->goHome();
    }

    public function actionEdit() {
        $model = Users::findOne(['user_id' => yii::$app->user->id]);
        $model->scenario = 'edit';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!empty($model->oldPassword) && !empty($model->newPassword)) {
                if ($model->validatePassword($model->oldPassword)) {
                    $model->setPassword($model->newPassword);
                    $model->save();
                    Yii::$app->session->setFlash('success', 'Data changed');
                    return $this->redirect('account');
                } else {
                    $model->addError('oldPassword', 'Incorect password');
                }
            }
        }
        return $this->render("edit", ['model' => $model]);
    }

    public function actionForgot() {
        $model = new \app\models\ForgotForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = Users::findOne(['email' => $model->email]);
            $user->generateResetPasswordKey()->save();
            yii::$app->mailer->compose('/email/forgot', ['user' => $user])
                    ->setFrom('sbs@samrov.com')
                    ->setTo($user->email)
                    ->setSubject('Restore password link')
                    ->send();
            yii::$app->session->setFlash('success', 'Check your email');
            return $this->goHome();
        }
        return $this->render('forgot', ['model' => $model]);
    }

    public function actionReset($key) {
        $model = new \app\models\ResetForm();
        $user = Users::findByResetPasswordKey($key);
        if ($user == null) {
            yii::$app->session->setFlash('danger', 'Incorect key');
            return $this->goHome();
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->setPassword($model->newPassword);
            $user->reset_password_key = null;
            $user->save();
            yii::$app->session->setFlash('success', 'Password successfully changed');
            return $this->goHome();
        }
        return $this->render('reset', ['model' => $model, 'key' => $key]);
    }

}
