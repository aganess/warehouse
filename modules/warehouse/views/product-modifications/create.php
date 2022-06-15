<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\products\ProductModifications */

$this->title = 'Создание модификации продукта';
$this->params['breadcrumbs'][] = ['label' => 'Модификации продукта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-modifications-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
