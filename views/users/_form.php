<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = ($model->scenario == 'edit') ? $model->email : 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login col-lg-4" style="margin: auto;float:none">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
                'id' => 'login-form',
//                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
//                    'template' => '{label}<div class="col-lg-2">{input}</div><div class="col-lg-8">{error}</div>',
//                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                ],
    ]);
    ?>

    <?php if ($model->scenario == 'edit'): ?>
        <?= $form->field($model, 'oldPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword_repeat')->passwordInput() ?>
    <?php else: ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>
    <?php endif; ?>
    <!--<div class="form-group">-->
        <!--<div class="col-lg-offset-1 col-lg-11">-->
        <!--<div class="">-->
            <?= Html::submitButton(($model->scenario == 'edit') ? 'Change' : 'Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <!--</div>-->
    <!--</div>-->

    <?php ActiveForm::end(); ?>

</div>
