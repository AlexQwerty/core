<div class="row">
    <div class="col-lg-5">
        <ul>
            <li>Windows 7/Vista/Xp, Linux (Ubuntu, Debian)</li>
            <li><code>PHP5</code> as the main programming language</li>
            <li>set of Apache as application servers</li>
            <li><code>MySql</code> / <code>MongoDb</code> as database servers and session storage</li>
            <li>Mercurial as version control and project management system</li>
            <li>Nginx web servers as load balancers and reverse-proxy</li>
            <li>APC / Memcached for caching</li>
            <li>Sphinx as a full-text search engine</li>
            <li>Zend framework, <code>Yii 1.1.*</code> as php framework</li>
            <li>Html, Css, XML, JSON</li>
            <li>Js / jQuery, RaphaelJs as javascript vector graphic library</li>
            <li><code>NodeJs</code> to increase the performance of background tasks and implementations WebSockets</li>
            <li>Wordpress</li>
        </ul>
    </div>
    <?= yii\helpers\Html::img(yii::getAlias('@web/img/logo.png'), ['class' => 'col-lg-7']); ?>
</div>
<?php
parse_str($_SERVER['QUERY_STRING'], $get);
echo "<pre>";
print_r(parse_url($_SERVER['REQUEST_URI']));
print_r($get);
echo "</pre>";

$t = microtime(true);

echo '<div style="display:none;">';

echo "</div><br>";

$t1 = microtime(true);
echo $t1 - $t;

echo '<div style="display:none;">';

echo "</div><br>";


$t2 = microtime(true);
echo $t2 - $t1;

echo '<div style="display:none;">';

echo "</div><br>";


$t3 = microtime(true);
echo $t3 - $t2;