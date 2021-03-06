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

$action = Yii::$app->controller->action->id;
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
        <?= $form->field($model, 'to')->widget(Select2::classname(), [
            'data' => $model->getAllUsers(),
            'value' => $model->to ?? null,
            'options' => ['placeholder' => 'Выберите значение ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Кому') ?>
    </div>

    <?php if ($action === 'update'): ?>
        <div class="col">
            <?= $form->field($model, 'from')->widget(Select2::classname(), [
                'data' => $model->getAllUsersOrWarehouses(),
                'value' => $model->to ?? null,
                'options' => ['placeholder' => 'Выберите значение ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('От кого ') ?>
        </div>
    <?php endif; ?>

    <div class="col">
        <?= $form->field($model, 'how_send')->widget(Select2::classname(), [
            'data' => $model->setAllSendTypes(),
            'value' => $model->to ?? null,
            'options' => ['placeholder' => 'Выберите значение ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Как отправить') ?>
    </div>

    <div class="col">
        <?= $form->field($model, 'address')->textInput()->label('Адрес') ?>
    </div>

    <div class="col">
        <?= $form->field($model, 'file')->fileInput() ?>
    </div>
</div>