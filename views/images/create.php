<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form ActiveForm */
?>
<div class="products-add col-lg-8" style="margin: auto;float: none;">

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>

    <!--<div class="col-lg-12">-->
    <?= $form->field($model, 'describe')->textarea() ?>
    <!--</div>-->
    <!--<div class="col-lg-2">-->
    <?= $form->field($model, 'file')->fileInput() ?>
    <!--</div>-->
    <!--<div class="col-lg-12">-->
    <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
    <!--</div>-->
    <?php ActiveForm::end(); ?>

</div><!-- products-add -->
