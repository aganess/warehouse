<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\warehouse\models\products\search\ProductsActionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Действия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-actions-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            [
                'attribute' => 'to',
                'label' => 'Пользователь',
                'value' => function ($model) {
                    return Yii::$app->getter->getUserById($model['to']);
                }
            ],
            [
                'attribute' => 'how_send',
                'label' => 'Как отправлено',
                'value' => function ($model) {
                    return $model::getAllSendTypes($model['how_send']);
                }
            ],
            'address',
            'documents',
            'documents_comment:ntext',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model['status'] == 1 ? '<span style="color: green">Одобрено</span>' : '<span style="color: red">Не одобрено</span>';
                },
                'format' => 'raw'
            ],
            'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>