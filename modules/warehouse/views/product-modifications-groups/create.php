<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\products\ProductsModificationsGroups */

$this->title = 'Создание модификации для групп';
$this->params['breadcrumbs'][] = ['label' => 'Модификации для групп', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-modifications-groups-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
