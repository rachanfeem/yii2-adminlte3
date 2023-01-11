<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = Yii::t('all', 'รายละเอียด');
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card ">
        <div class="card-header border-0 ui-sortable-handle bg-gradient-info" >
            <h3 class="card-title">
                <i class="fa fa-eye mr-1"></i> <?= "<?=" ?> Yii::t('all', 'รายละเอียดข้อมูล') ?>
            </h3>
            <!-- card tools -->
            <div class="card-tools">
                <?= "<?=" ?> Html::a('<i class="fa fa-reply"></i>', 
                    ['index'], 
                    [
                        'class' => 'btn btn-sm btn-default',
                        'title'=> Yii::t('all', 'กลับหน้าหลัก'),
                        'data-toggle' => "tooltip",
                    ]
                ) ?>
                <?= "<?php" ?> if(Yii::$app->user->can('<?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>/create')){  ?>
                    <?= "<?=" ?> Html::a('<i class="fa fa-plus"></i>', 
                        [
                            'create'
                        ], 
                        [
                            'class' => 'btn btn-sm btn-success',
                            'title'=> Yii::t('all', 'เพิ่มข้อมูล'),
                            'data-toggle' => "tooltip",
                        ]
                    ) ?>
                <?= "<?php" ?> } ?>
                <?= "<?php" ?> if(Yii::$app->user->can('<?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>/update')){ ?>
                    <?= "<?=" ?> Html::a('<i class="fa fa-edit"></i>', 
                        [
                            'update', 
                            'id' => $model->id                    
                        ], 
                        [
                            'class' => 'btn btn-sm btn-warning',
                            'title'=> Yii::t('all', 'แก้ไขข้อมูล'),
                            'data-toggle' => "tooltip",
                        ]
                    ) ?>
                <?= "<?php" ?> } ?>
                <?= "<?php" ?> if(Yii::$app->user->can('<?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>/delete')){ ?>
                    <?= "<?=" ?> Html::a('<i class="fa fa-trash"></i>', 
                        [
                            'delete', 'id' => $model->id                    
                        ], 
                        [
                            'class' => 'btn btn-sm btn-danger',
                            'title'=> Yii::t('all', 'ลบข้อมูล'),
                            'data-toggle' => "tooltip",
                            'data' => [
                                'confirm' => Yii::t('all', 'คุณต้องการลบข้อมูลใช่หรือไม่'),
                                'method' => 'post',
                            ],
                        ]
                    ) ?>
                <?= "<?php" ?> } ?>
                <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-card-widget="collapse" title="<?= "<?=" ?> Yii::t('all', 'ย่อ/ขยาย') ?>">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <?= "<?= " ?>DetailView::widget([
                        'model' => $model,
                        'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "                            [
            \t\t\t\t\t'attribute' => '" . $name . "',
            \t\t\t\t\t'captionOptions' => ['width' => '30%'],
        \t\t\t\t\t],\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        echo "                            [
            \t\t\t\t\t'attribute' => '" . $column->name . "',
            \t\t\t\t\t'captionOptions' => ['width' => '30%'],
        \t\t\t\t\t],\n";
    }
}
?>
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>