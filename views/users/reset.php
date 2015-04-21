<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-login col-lg-4" style="margin: auto;float:none">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
                'id' => 'reset-form'
    ]);
    ?>

    <?= Html::hiddenInput('key', $key) ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'newPassword_repeat')->passwordInput() ?>

    <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

    <?php ActiveForm::end(); ?>

</div>