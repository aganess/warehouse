<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\warehouses\Warehouses */

$this->title = 'Создание склада';
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouses-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
