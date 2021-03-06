<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\modules\warehouse\models\WarehouseEntities;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/warehouse']],
            ['label' => 'Продукты', 'url' => ['/warehouse/products']],
            ['label' => 'Склады', 'url' => ['/warehouse/warehouses']],
            ['label' => 'Пользователи', 'url' => ['/warehouse/users']],
            ['label' => 'Объекты ', 'url' => ['/warehouse/objects']],
            ['label' => 'Номенклатурные группы', 'url' => ['/warehouse/nomenclature-groups']],
            ['label' => 'Заявки', 'items' => [
                ['label' => 'Создать заявку', 'url' => ['/warehouse/products-actions/create', 'type' => 5]],
                ['label' => 'Одобрить заявку', 'url' => ['/warehouse/products-actions', 'type' => 5]],
            ],
            ],
            ['label' => 'Действия', 'items' => [
                ['label' => 'Единицы измерения', 'url' => '/warehouse/measurement'],
                ['label' => 'Модификации', 'url' => '/warehouse/product-modifications'],
                ['label' => 'Назначить модификацию группам', 'url' => '/warehouse/product-modifications-groups'],
                ['label' => 'Создать', 'url' => '/warehouse/products-actions']
            ],
            ],
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
