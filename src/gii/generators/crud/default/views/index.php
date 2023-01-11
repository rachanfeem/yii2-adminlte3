<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\helpers\Url;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use richardfan\widget\JSRegister;

$defaultConfig = (new ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
<?= $generator->enablePjax ? "           <?php Pjax::begin(); ?>\n" : '' ?>
<?php if(!empty($generator->searchModelClass)): ?>
<?= "           <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "       <?php " ?>$dynagrid = DynaGrid::begin([
                'options'=>[
                    'id'=>'<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>',// a unique identifier is important
                    'class'=>['table-sm'],
                ],
                'theme'=>'panel-info',
                'showPersonalize'=>true,
                'storage' => DynaGrid::TYPE_DB,
                'showFilter'=>false,
                'showSort'=>false,
                'allowSortSetting'=>false,
                'allowFilterSetting'=>false,
                'gridOptions'=>[
                    'exportConfig' => [
                        GridView::HTML => [
                            'label' => Yii::t('all', 'HTML'),
                            'showHeader' => true,
                            'showPageSummary' => true,
                            'showFooter' => true,
                            'showCaption' => true,
                            'filename' => $this->title,
                            'alertMsg' => Yii::t('all', 'The HTML export file will be generated for download.'),
                            'options' => ['title' =>Yii::t('all', 'Hyper Text Markup Language.')],
                            'mime' => 'text/html',
                        ],
                        GridView::CSV => [
                            'label' => Yii::t('all', 'CSV'),
                            'showHeader' => true,
                            'showPageSummary' => true,
                            'showFooter' => true,
                            'showCaption' => true,
                            'filename' => $this->title,
                            'alertMsg' => Yii::t('all', 'The CSV export file will be generated for download.'),
                            'options' => ['title' =>Yii::t('all', 'Comma Separated Values.')],
                            'mime' => 'application/csv',
                            'config' => [
                                'colDelimiter' => ",",
                                'rowDelimiter' => "\r\n",
                            ]
                        ],
                        GridView::TEXT => [
                            'label' => Yii::t('all', 'TEXT'),
                            'showHeader' => true,
                            'showPageSummary' => true,
                            'showFooter' => true,
                            'showCaption' => true,
                            'filename' =>$this->title,
                            'alertMsg' => Yii::t('all', 'The TEXT export file will be generated for download.'),//
                            'options' => ['title' => Yii::t('all', 'Tab Delimited Text.')],
                            'mime' => 'text/plain',
                            'config' => [
                                'colDelimiter' => "\t",
                                'rowDelimiter' => "\r\n",
                            ]
                        ],
                        GridView::EXCEL => [
                            'label' => Yii::t('all', 'EXCEL'),
                            'showHeader' => true,
                            'showPageSummary' => true,
                            'showFooter' => true,
                            'showCaption' => true,
                            'filename' => $this->title,
                            'alertMsg' => Yii::t('all', 'The EXCEL export file will be generated for download.'),
                            'options' => ['title' => Yii::t('all', 'Microsoft Excel 95+')],
                            'mime' => 'application/vnd.ms-excel',
                            'config' => [
                                'worksheet' => 'ExportWorksheet',
                                'cssFile' => ''
                            ]
                        ],
                        GridView::PDF => [
                            'label' => Yii::t('all', 'PDF'),
                            'showHeader' => true,
                            'showPageSummary' => true,
                            'showFooter' => true,
                            'showCaption' => true,
                            'filename' => $this->title,
                            'alertMsg' =>Yii::t('all', 'The PDF export file will be generated for download.'),
                            'options' => ['title' =>Yii::t('all', 'Portable Document Format')],
                            'mime' => 'application/pdf',
                            'config' => [
                                'mode' => 'UTF-8',
                                'format' => 'A4-L',
                                'destination' => 'D',
                                'marginTop' => 20,
                                'marginBottom' => 20,
                                'cssFile' => '@backend/web/css/pdf/kartik-pdf.css',
                                'cssInline' => '',
                                'methods' => [
                                    'SetHeader' => [
                                        ['odd' => '123', 'even' => '456']
                                    ],
                                    'SetFooter' => [
                                        ['odd' => '789', 'even' => '987']
                                    ],
                                ],
                                'options' => [
                                    'title' => $this->title,
                                    'subject' => Yii::t('all', 'PDF export generated by kartik-v/yii2-grid extension'),
                                    'keywords' => 'krajee, grid, export, yii2-grid, pdf',
                                    'fontDir'=>array_merge($fontDirs, [
                                        Yii::getAlias('@webroot').'/fonts'
                                    ]),
                                    'fontdata'=>$fontData + [
                                        'thsarabunpsk' => [
                                            'R' => 'THSarabun.ttf',
                                        ],

                                    ],
                                ],
                                'contentBefore'=>'',
                                'contentAfter'=>''
                            ],
                        ],
                    ],
                    'pager' => [
                        'maxButtonCount'=>5,
                        'options'=>['class'=>'pagination'],
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                        'firstPageLabel'=> '<<',
                        'lastPageLabel'=> '>>',
                        'nextPageCssClass'=>'next',
                        'prevPageCssClass'=>'prev',
                        'firstPageCssClass'=>'first',
                        'lastPageCssClass'=>'last',
                    ],
                    'dataProvider'=>$dataProvider,
                    'filterModel' => $searchModel,
                    'showPageSummary'=>false,
                    'floatHeader'=>false,
                    // 'pjax'=>true,
                    'responsiveWrap'=>false,
                    'responsive'=>true,
                    'hover' => true,
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                    'persistResize' => false,
                    'krajeeDialogSettings' => [
                        'options' => ['title' => Yii::t('all', 'การแจ้งเตือนการลบ')],
                        //'overrideYiiConfirm' => false, 'useNative' => true
                    ],
                    'panel'=>[
                        'heading'=>'<h3 class="panel-title"><i class="fa fa-list"></i> ' . Yii::t('all', 'รายการ') . '</h3>',
                        'before' =>'',
                        'after' => false
                    ],
                    'toolbar' =>  [
                        [
                            'content' => Html::a('<i class="fas fa-plus"></i>',
                                Url::to(['create']),
                                [
                                    'class'=>'btn btn-success',
                                    'data-toggle' => "tooltip",
                                    'title'=>Yii::t('all','เพิ่มข้อมูล'),
                                    'style' => [
                                        /*'display'=> Yii::$app->user->can('<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/create') ? 'block' : 'none'*/
                                    ]
                                ])
                        ],
                        ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}{toggleData}'],
                        '{export}',
                    ]
                ],
                <?=                   "'columns' => [\n"; ?>
                    [
                        'class' => 'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT
                    ],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "                       ['attribute' => '" . $name . "'],\n";
        } else {
            echo "                            //['attribute' => '" . $name . "'],\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "                    [
                \t\t'attribute' => '" . $column->name ."',
                \t\t'headerOptions' => ['class' => 'text-center'],
                \t\t'contentOptions' => [],
                \t\t'vAlign' => 'middle',
                \t\t'format' => 'raw',
                \t\t'visible' => true,
            \t\t],\n";
        } else {
            echo "                    [
                \t\t'attribute' => '" . $column->name ."',
                \t\t'headerOptions' => ['class' => 'text-center'],
                \t\t'contentOptions' => [],
                \t\t'vAlign' => 'middle',
                \t\t'format' => 'raw',
                \t\t'visible' => false,
            \t\t],\n";
        }
    }
}
?>

                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'buttonOptions'=>['class'=>'btn btn-default'],
                        'template'=>'<div class="btn-group btn-group-xs text-center" role="group">{view} {update} {delete}</div>',
                        'visibleButtons'=>[
                            // 'view' => Yii::$app->user->can('<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/view'),
                            // 'update' => Yii::$app->user->can('<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/update'),
                            // 'delete' => Yii::$app->user->can('<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/delete')
                        ],
                        'buttons'=>[
                            
                            'view' => function($url, $model, $key){
                                return Html::a('<i class="fas fa-eye"></i>',
                                    $url,
                                    [
                                        'class' => 'btn btn-info',
                                        'title' => Yii::t('all', 'รายละเอียด'),
                                        'data-toggle' => "tooltip",
                                    ]
                                );

                            },
                            'update' => function($url, $model, $key){
                                return Html::a('<i class="fas fa-pencil-alt"></i>',
                                    $url,
                                    [
                                        'class' => 'btn btn-warning',
                                        'title' => Yii::t('all', 'แก้ไขข้อมูล'),
                                        'data-toggle' => "tooltip",
                                    ]
                                );
                            },
                            'delete' => function($url, $model, $key){
                                return Html::a('<i class="fas fa-trash-alt"></i>',
                                    $url,
                                    [
                                        'class' => 'btn btn-danger',
                                        'title' => Yii::t('all', 'ลบข้อมูล'),
                                        'data-toggle' => "tooltip",
                                        'data' => [
                                            'method' => 'POST',
                                            'confirm' => Yii::t('all', 'คุณต้องการลบข้อมูลใช่หรือไม่'),
                                        ],

                                    ]
                                );
                            },
                        ],
                    ],
                    /*[
                        'class' => 'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT
                    ],*/
                ],

            ]);
            if (substr($dynagrid->theme, 0, 6) == 'simple') {
                $dynagrid->gridOptions['panel'] = false;
            }
            DynaGrid::end();
            ?>
<?php else: ?>
    <?= "               <?= " ?>ListView::widget([
                        'dataProvider' => $dataProvider,
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                        },
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                            'options' => ['class' => 'pagination mt-3'],
                        ]
                    ]) ?>
<?php endif; ?>

<?= $generator->enablePjax ? "                    <?php Pjax::end(); ?>\n" : '' ?>

        </div>
        <!--.col-md-12-->
    </div>
</div>