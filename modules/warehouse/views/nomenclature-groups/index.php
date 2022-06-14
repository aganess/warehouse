<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\warehouse\models\nomenclatureGroup\search\NomenclatureGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Номенклатурные группы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomenclature-groups-index">

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
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return $model::getParent($model['parent_id']);
                }
            ],
            'title',
            Yii::$app->grid->getStatus(),
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
