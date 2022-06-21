<?php
/**
 * KM Websolutions Projects
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2010 KM Websolutions
 * @license http://www.yiiframework.com/license/
 */

/**
 * This layout is the skeleton for login and registration page and for all other
 * pages who don't need header and sidebar menu.
 */

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::cssFile(YII_DEBUG ? '@app/themes/adminlte/css/app.css' : '@app/themes/adminlte/css/app.min.css?v=' . filemtime(Yii::getAlias('@webroot/themes/adminlte/css/app.min.css'))) ?>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <?php $this->head() ?>
</head>
<?php
?>
<body class="blank-layout app-justify-center flex-row align-items-center<?= isset($this->params['bodyCssClass']) ? " {$this->params['bodyCssClass']}" : '' ?>">
<?php $this->beginBody() ?>
<?= $content ?>
<?= Html::jsFile(YII_DEBUG ? '@app/themes/adminlte/js/app.js' : '@app/themes/adminlte/js/app.min.js?v=' . filemtime(Yii::getAlias('@webroot/themes/adminlte/js/app.min.js'))) ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>