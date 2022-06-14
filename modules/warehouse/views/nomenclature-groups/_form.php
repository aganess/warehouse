<?php

use app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nomenclature-groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(NomenclatureGroups::getAllCategories()) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= Yii::$app->grid->setStatus($form, $model) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
