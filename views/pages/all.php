<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', ucfirst($this->context->id));
$this->params['breadcrumbs'][] = $this->title;
$columns = (method_exists($searchModel, 'getCrudColumns')) ? $searchModel->getCrudColumns() : $searchModel->safeAttributes();
$columns[] = ['class' => 'yii\grid\ActionColumn'];
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']); ?></p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns
    ]);
    ?>

</div>

