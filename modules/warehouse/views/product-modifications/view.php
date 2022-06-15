<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\products\ProductModifications */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Модификации продукта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-modifications-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Обновтиь', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            Yii::$app->grid->getStatus(),
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
