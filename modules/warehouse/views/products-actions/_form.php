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

$css = <<<CSS
    .list-cell__product_ids    {width: 400px}
    .list-cell__quantity       {width: 122px}
    .list-cell__measurement    {width: 122px}
    .list-cell__rost           {width: 122px}
    .list-cell__nomer-partii   {width: 122px}
    .list-cell__sostoyanie     {width: 122px}
    .list-cell__razmer         {width: 122px}
    .list-cell__cvet           {width: 122px}
CSS;
$this->registerCss($css);
?>

<div class="receipt-products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $model->type = $defaultType ?>
    <?= $form->field($model, 'type')->dropDownList($model->getAllTypes(), [
        'id'       => 'types',
        'disabled' => Yii::$app->controller->action->id === 'update' ? 'disables' : false
    ]) ?>

    <?php if ($defaultType == 1) : ?>
        <?= $this->render('parts/_render_type_1', [
            'form' => $form,
            'model' => $model
        ]) ?>
    <?php endif; ?>

    <?php if ($defaultType == 2) : ?>
        <?= $this->render('parts/_render_type_2', [
            'form' => $form,
            'model' => $model
        ]) ?>
    <?php endif; ?>

    <?php if ($defaultType == 3) : ?>
        <?= $this->render('parts/_render_type_3', [
            'form' => $form,
            'model' => $model
        ]) ?>
    <?php endif; ?>

    <?php if ($defaultType == 4) : ?>
        <?= $this->render('parts/_render_type_4', [
            'form' => $form,
            'model' => $model
        ]) ?>
    <?php endif; ?>
    <?php if ($defaultType == 5): ?>
        <?= $this->render('parts/_render_type_5', [
            'form' => $form,
            'model' => $model
        ]) ?>
    <?php endif; ?>
    <div class="form-row">
        <div class="col">
            <?= $form->field($model, 'products')->widget(MultipleInput::className(), [
                'max' => 1000,
                'min' => 1,
                'cloneButton' => true,
                'iconSource' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
                'columns' => Yii::$app->grid->setDynamicColumns($form, $model),
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

<?php if (!empty($model->products)):?>
    <?php foreach ($model->products as $key => $product) :?>
        <?php $product_name = $model->getOneProductName($product['product_id']) ; $k = $key; ?>
        <?php $js = <<<JS
    var  key = "$k";
    $('#select2-productsactions-products-' + key + '-product_id-container').text("$product_name");
JS;
        $this->registerJs($js)
        ?>
    <?php endforeach;?>
<?php endif;?>


<?php $js = <<<JS
    $('#types').change(function() {
      window.location.href = window.location.pathname +"?type=" + $(this).val();
    });
JS;
$this->registerJs($js)
?>