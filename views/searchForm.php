<?php

use yii\jui\DatePicker;
use yii\helpers\Html;
use app\models\search\Categories;
use yii\helpers\ArrayHelper;
?>
<!--<div class="bs-docs-header">-->
<!--<div class="col-lg-4">&nbsp;</div>-->
<div class="col-lg-4" style="background-color: #f5f5f5;min-height: 247px;margin-top: 20px;border-radius: 0.7em;border:1px #ddd solid;padding-top: 10px;">
    <!--<div class="head-opacity"></div>-->
    <!--<div class="head-content">-->
    <!--<h1>Car Rental in Denver</h1>-->
    <form class="bs-example bs-example-form search-form" role="form" action="<?= Yii::$app->homeUrl; ?>cars/search" method="get">
        <div class="col-lg-8" style="padding: 0px;">
            <h5><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Pick-up Date/Time</h5>   
            <div class="input-group">
                <label class="input-group-addon" for="dp-from"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
                <?php
                echo DatePicker::widget([
                    'name' => 'search[calc][from_date]',
                    'value' => isset($_REQUEST['search']['calc']['from_date']) ? $_REQUEST['search']['calc']['from_date'] : time(),
                    'language' => 'en',
                    'dateFormat' => 'yyyy-MM-dd',
                    'id' => 'dp-from',
                    'clientOptions' => [
                        'minDate' => date('Y-m-d'),
                        'onSelect' => new yii\web\JsExpression('function(selectedDate) {$("#dp-to").datepicker("option", "minDate", selectedDate);}')],
                    'options' => ['class' => "form-control"],
                ]);
                ?>
            </div>
        </div>
        <div class="col-lg-4" style="padding-right: 0px;">
            <h5><span class="glyphicon glyphicon-time" aria-hidden="true"></span> </h5>
            <?= Html::dropDownList('search[calc][from_hour]', isset($_REQUEST['search']['calc']['from_hour']) ? $_REQUEST['search']['calc']['from_hour'] : 0, \Yii::$app->params['hours'], ['class' => 'select-category btn btn-default dropdown-toggle', 'style' =>'width:100%']); ?> 
        </div>
        <div class="col-lg-8" style="padding: 0px;">
            <h5> <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Return Date/Time</h5>
            <div class="input-group">
                <label class="input-group-addon" for="dp-to"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
                <?php
                echo DatePicker::widget([
                    'name' => 'search[calc][to_date]',
                    'value' => isset($_REQUEST['search']['calc']['to_date']) ? $_REQUEST['search']['calc']['to_date'] : time() + 24 * 3600,
                    'language' => 'en',
                    'dateFormat' => 'yyyy-MM-dd',
                    'id' => 'dp-to',
                    'clientOptions' => [
                        'minDate' => date('Y-m-d', time() + 24 * 3600),
                        'onSelect' => new yii\web\JsExpression('function(selectedDate) {$("#dp-from").datepicker("option", "maxDate", selectedDate);}')
                    ],
                    'options' => ['class' => "form-control"]
                ]);
                ?>
            </div>
        </div>
        <div class="col-lg-4" style="padding-right: 0px;">
            <h5><span class="glyphicon glyphicon-time" aria-hidden="true"></span> </h5>
            <?= Html::dropDownList('search[calc][to_hour]', isset($_REQUEST['search']['calc']['to_hour']) ? $_REQUEST['search']['calc']['to_hour'] : 0, \Yii::$app->params['hours'], ['class' => 'select-category btn btn-default dropdown-toggle', 'style' =>'width:100%']); ?> 
        </div>
        <div class="col-lg-8" style="padding: 0px;">
            <h5><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Category</h5>
            <?= Html::dropDownList('search[category]', isset($_REQUEST['search']['category']) ? $_REQUEST['search']['category'] : 0, ArrayHelper::map(Categories::find()->all(), 'category_id', 'name'), ['class' => 'select-category btn btn-default dropdown-toggle', 'prompt' => 'All Categories', 'style'=>'width:100%;margin-right:10px;']); ?>    
        </div>

        <div class="col-lg-4" style="padding-top: 38px">
            <a class="btn btn-primary btn-sm" href="#" role="button"  onclick="$(this).closest('form').submit()">Search Car</a>
        </div>
    </form>
    <!--</div>-->
</div>
<!--<div class="col-lg-4">&nbsp;</div>-->
<!--</div>-->
