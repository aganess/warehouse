<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups */

$this->title = 'Обновление номенклатурного группы: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Номенклатурные группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nomenclature-groups-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
