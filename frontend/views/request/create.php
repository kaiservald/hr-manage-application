<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Request */

$this->title = $vacancy->title . ' (Створення запиту на роботу)';
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'vacancy' => $vacancy
    ]) ?>

</div>
