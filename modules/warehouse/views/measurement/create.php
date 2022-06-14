<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\warehouse\models\measurement\Measurement */

$this->title = 'Создать единица измерения';
$this->params['breadcrumbs'][] = ['label' => 'Единицы измерения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="measurement-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
