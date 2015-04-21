<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-4" style="margin:auto;float:none">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to login:</p>
    <?php
    $form = ActiveForm::begin([
                'id' => 'login-form'
    ]);
    ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <div style="padding-bottom: 15px">
        <a href="/registration">Need an account</a>&nbsp;&nbsp;&nbsp;
        <a href="/forgot">Forgot password</a>
    </div>
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    <?php ActiveForm::end(); ?>
</div>

