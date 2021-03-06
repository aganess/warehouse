<?php
/* @var $this yii\web\View */
/* @var $model ProductsActions */

/* @var $form yii\widgets\ActiveForm */

/* @var $defaultType integer */

use app\modules\warehouse\models\products\ProductsActions;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\Url;
use unclead\multipleinput\MultipleInput;

?>


<div class="form-row">
    <div class="col">
        <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::classname(), [
            'options' => ['placeholder' => 'Введите дату...'],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]); ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'from')->widget(Select2::classname(), [
            'data' => $model->getAllWarehouses(),
            'value'=> $model->to ?? null,
            'options' => ['placeholder' => 'Выберите значение ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('От кого') ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'to')->widget(Select2::classname(), [
            'data' => $model->getAllUsersOrObjects(),
            'value'=> $model->from ?? null,
            'options' => ['placeholder' => 'Выберите значение ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Получатель') ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'file')->fileInput() ?>
    </div>
</div>