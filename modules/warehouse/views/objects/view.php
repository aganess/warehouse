<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $data array */
/* @var $model app\modules\warehouse\models\Objects */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Objects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="objects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

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
