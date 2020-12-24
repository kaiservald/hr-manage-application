<?php

/* @var $this \yii\web\View */
/* @var $content string */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $logoIgm = '<span>' . Html::img('/images/logo.svg', ['alt' => 'My logo', 'width' => '150px']) . '<span>';

    NavBar::begin([
        'brandLabel' => $logoIgm . Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-dark bg-primary',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'All vacancies', 'url' => ['/vacancy/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        if (Yii::$app->user->can('authUser')) {
            $dropDownItems[] = ['label' => "Мої запити", 'url' => '/request/my'];
            $dropDownItems[] = "<div class='dropdown-divider'></div>";
        }
        if (Yii::$app->user->can('manager')) {
            $dropDownItems[] = ['label' => "Manage my vacancies", 'url' => '/vacancy/my'];
            $dropDownItems[] = ['label' => "New vacancy", 'url' => '/vacancy/create'];
            $dropDownItems[] = "<div class='dropdown-divider'></div>";
        }
        if (Yii::$app->user->can('admin')) {
            $dropDownItems[] = ['label' => "Manage all vacancies", 'url' => '/vacancy/admin'];
            $dropDownItems[] = "<div class='dropdown-divider'></div>";
        }
        $dropDownItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
        $menuItems[] = [
            'label' => FAS::icon('user-circle')->size(FAS::SIZE_4X),
            'items' => $dropDownItems
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto align-items-center'],
        'items' => $menuItems,
        'encodeLabels' => false
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
