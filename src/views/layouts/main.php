<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\rachan\adminlte3\assets\AdminLteAsset::register($this);
\rachan\adminlte3\assets\PluginAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->render('navbar', ['assetDir']) ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->render('sidebar', ['assetDir']) ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->render('content', ['content' => $content, 'assetDir']) ?>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <?= $this->render('control-sidebar') ?>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?= $this->render('footer') ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>