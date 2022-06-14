<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups */

$this->title = 'Создание номенклатурных групп';
$this->params['breadcrumbs'][] = ['label' => 'Номенклатурные группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomenclature-groups-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
