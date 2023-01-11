<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */

$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>
    <div class="row">

        <?php foreach ($generator->getColumnNames() as $attribute) {

            if (in_array($attribute, $safeAttributes)) {

                echo "\t<div class='col-md-6 offset-md-3'>\n";
                echo "\t\t\t<?= " . $generator->generateActiveField($attribute) . " ?>\n";
                echo "\t\t</div>\n\n\t";
            }
        } ?>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <?= "<?= " ?>Html::submitButton(Yii::t('all', 'บันทึก'), ['class' => 'btn btn-success btn-block mt-3']) ?>
            </div>
        </div>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>