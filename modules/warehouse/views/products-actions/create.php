<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $defaultType integer   */
/* @var $model app\modules\warehouse\models\products\ProductsActions */

$this->title = 'Создание Действии';
$this->params['breadcrumbs'][] = ['label' => 'Действия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-actions-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model'       => $model,
        'defaultType' => $defaultType,
    ]) ?>

</div>
