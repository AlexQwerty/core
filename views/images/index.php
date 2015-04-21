<?php

echo yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => "/images/_list",
    'itemOptions' => ['class' => 'col-lg-3 col-md-2 col-sm-3 col-xs-6', 'style' => 'padding-left:5px;padding-right:5px;'],
    'layout' => '<div>{summary}</div><div class="">{items}</div><div class="text-center" style="clear:both">{pager}</div>'
]);