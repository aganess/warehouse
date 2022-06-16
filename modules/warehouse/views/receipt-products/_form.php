<?php

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\products\ReceiptProducts */

/* @var $form yii\widgets\ActiveForm */

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\Url;
use unclead\multipleinput\MultipleInput;

$css = <<<CSS
    .list-cell__product_ids    {width: 400px}
    .list-cell__quantity       {width: 100px}
    .list-cell__measurement    {width: 100px}
CSS;
$this->registerCss($css);


$columns =
    [
        'name' => 'quantity',
        'title' => 'Размер',
        'defaultValue' => 1,
        'options' => [
            'type' => 'number'
        ]
    ];

?>

<div class="receipt-products-form">

    <?php $form = ActiveForm::begin(); ?>
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
            <?= $form->field($model, 'from')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'to')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'documents')->fileInput() ?>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <?= $form->field($model, 'products')->widget(MultipleInput::className(), [
                'max' => 1000,
                'min' => 1,
                'cloneButton' => true,
                'iconSource' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
                'columns' => [
                    [
                        'name' => 'product_ids',
                        'type' => Select2::className(),
                        'title' => 'Номеклатура',
                        'options' => [
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 1,
                                'language' => 'ru',
                                'ajax' => [
                                    'url' => \yii\helpers\Url::to(['/warehouse/ajax/get-products']),
                                    'dataType' => 'json',
                                    'data' => new \yii\web\JsExpression(
                                        'function(params) { 
                                                        return {q:params.term} 
                                            }'
                                    )
                                ],
                                'escapeMarkup' => new JsExpression(
                                    'function (markup) {
                                                    console.log("escapeMarkup"); return markup; 
                                        }'
                                ),
                                'templateResult' => new JsExpression(
                                    'function(data) {
                                                    console.log("templateResult"); 
                                                    console.log(data); return data.name;
                                         }'
                                ),
                                'templateSelection' => new JsExpression(
                                    'function (data) {
                                                    console.log("templateSelection"); 
                                                    $("#discipline_text").val(data.name); 
                                                    console.log(data);
                                                    return data.name;
                                        }'
                                ),
                            ],
                        ],
                    ],
                    [
                        'name' => 'quantity',
                        'title' => 'Количество',
                        'defaultValue' => 1,
                        'options' => [
                            'type' => 'number'
                        ]
                    ],
                    [
                        'name' => 'measurement',
                        'title' => 'Единица измерения',
                        'type' => 'dropDownList',
                        'items' => $model->getAllMeasurement(),
                        'options' => [
                            'type' => 'string'
                        ]
                    ],
                ]
            ])->label(false); ?>

        </div>
    </div>

    <?= $form->field($model, 'documents_comment')->textarea(['rows' => 6]) ?>

    <?= Yii::$app->grid->setStatus($form, $model) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
