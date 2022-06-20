<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $defaultType integer   */
/* @var $model app\modules\warehouse\models\products\ProductsActions */

$this->title = 'Обновление действии: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Действия', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="products-actions-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model'       => $model,
        'defaultType' => $defaultType,
    ]) ?>

</div>
