<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = Yii::t('all', 'เพิ่มข้อมูล');
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card ">
        <div class="card-header border-0 ui-sortable-handle bg-gradient-success">
            <h3 class="card-title">
                <i class="fa fa-plus mr-1"></i> <?= "<?= " ?> Yii::t('all', 'รายละเอียดข้อมูล') ?>
            </h3>
            <!-- card tools -->
            <div class="card-tools">
                <?= "<?=" ?> Html::a('<i class="fa fa-reply"></i>', ['index'], ['style'=>[], 'class' => 'btn btn-sm btn-default', 'data-toggle' => "tooltip", 'title' => Yii::t('all', 'กลับหน้าหลัก')]) ?>
                <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-card-widget="collapse" title="<?= "<?=" ?> Yii::t('all', 'ย่อ/ขยาย') ?>">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <?= "<?=" ?>$this->render('_form', [
            'model' => $model
            ]) ?>
        </div>
    </div>
</div>