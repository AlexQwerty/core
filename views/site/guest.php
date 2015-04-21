<div><a href="/products/add">Have something you want to sold?</a></div>
<?php

echo yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => "/products/_list",
    'itemOptions' => ['class'=>'col-lg-3 col-md-4 col-sm-6'],
    'layout' => '{summary}<div class="row col-lg-12">{items}</div><div class="col-lg-12">{pager}</div>'
]);
