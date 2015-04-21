<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-login col-lg-4" style="margin: auto;float:none">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
                'id' => 'forgot-form'
    ]);
    ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

    <?php ActiveForm::end(); ?>

</div>
