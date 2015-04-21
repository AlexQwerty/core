<div style="white-space: pre;">
<?php

if ($page == null) {
    throw new yii\web\HttpException(404, 'Page not found');
}
$this->title = $page->title;
echo $page->text;
?>
</div>
