<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\products\ProductsActions */

$this->title = 'Create Products Actions';
$this->params['breadcrumbs'][] = ['label' => 'Products Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-actions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
