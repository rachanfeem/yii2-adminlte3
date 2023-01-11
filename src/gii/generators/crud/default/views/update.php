<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = Yii::t('all', 'แก้ไขข้อมูล');
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title
?>

<div class="container-fluid">
    <div class="card ">
		<div class="card-header border-0 ui-sortable-handle bg-gradient-warning" >
			<h3 class="card-title">
				<i class="fa fa-edit mr-1"></i>
			</h3>
			<!-- card tools -->
			<div class="card-tools">
				<?= Html::a('<i class="fa fa-reply"></i>', 
					['index'], 
					[
						'class' => 'btn btn-sm btn-default',
						'title'=> Yii::t('all', 'กลับหน้าหลัก'),

					]
				) ?>
                <?php if(Yii::$app->user->can('location/create')){ ?>
					<?= Html::a('<i class="fa fa-plus"></i>', 
						[
							'create', 
						], 
						[
							'class' => 'btn btn-sm btn-success',
							'title'=> Yii::t('all', 'เพิ่มข้อมูล'),
						]
					) ?>
				<?php } ?>
                <?php if(Yii::$app->user->can('location/view')){ ?>
					<?= Html::a('<i class="fa fa-eye"></i>', 
						[
							'view', 'id' => $model->id               
						], 
						[
							'class' => 'btn btn-sm btn-info',
							'title' => Yii::t('all', 'รายละเอียด'),
						]
					) ?>
				<?php } ?>
                <?php if(Yii::$app->user->can('location/delete')){ ?>
					<?= Html::a('<i class="fa fa-trash"></i>', 
						[
							'delete', 'id' => $model->id                 
						], 
						[
							'class' => 'btn btn-sm btn-danger',
							'title'=> Yii::t('all', 'ลบข้อมูล'),
							'data' => [
								'confirm' => Yii::t('all', 'คุณต้องการลบข้อมูลใช่หรือไม่'),
								'method' => 'post',
							],

						]
					) ?>
				<?php } ?>
				<button type="button" class="btn btn-success btn-sm" data-card-widget="collapse" title="<?= Yii::t('all', 'ย่อ/ขยาย') ?>">
					<i class="fas fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="card-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>