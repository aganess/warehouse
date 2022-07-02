<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\warehouses\Warehouses */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Склады ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="warehouses-view">

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
            'title',
            'slug',
            [
                'attribute' => 'description',
                'value' => function ($model) {
                    return $model['description'];
                },
                'format' => 'raw'
            ],
            Yii::$app->grid->getStatus(),
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <br>

    <br>
    <?php if (!empty($data)): ?>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Продукт</th>
                <th scope="col">Количество</th>
                <th scope="col">Единицы измерения</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $key => $value): ?>
                <tr>
                    <td ><?= $value['name'] ?></td>
                    <td ><?= $value['count'] ?></td>
                    <td ><?= $value['measurement'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
