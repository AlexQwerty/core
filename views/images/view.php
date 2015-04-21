<?php
if ($model == null)
    throw new yii\web\HttpException(404, 'The post is not exist');
$format = new \yii\i18n\Formatter();
?>
<div class="col-lg-12">
    <div class="thumbnail">
        <div class="row">
            <div class="col-lg-12"><img src="<?= $model->imageUrl; ?>" alt="<?= $model->describe; ?>" style="width: 100%"></div>
            <div  class="col-lg-12">
                <?= $model->describe; ?>
            </div>
        </div>
    </div>
</div>
