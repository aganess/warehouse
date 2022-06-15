<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\products\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute' => 'group_id',
                'value' => function ($model) {
                    return $model['group']['title'];
                }
            ],
            [
                'attribute' => 'measurement_id',
                'value' => function ($model) {
                    return $model['measurement']['title'];
                }
            ],
            'title',
            'slug',
            [
                'attribute' => 'description',
                'value' => function ($model) {
                    return $model['description'];
                },
                'format' => 'raw'
            ],
            'manufacturer',
            'article',
            'quantity',
            'inventory_number',
            'expiration_date',
            Yii::$app->grid->getImg(),
            Yii::$app->grid->getStatus(),
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
