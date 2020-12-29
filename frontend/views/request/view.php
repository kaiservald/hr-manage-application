<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Request */

$this->title = "Запит на вакансію \"" . $model->vacancy->title . "\"";
$this->params['breadcrumbs'][] = ['label' => "Вакансії", 'url' => ['vacancy/index']];
$this->params['breadcrumbs'][] = ['label' => $model->vacancy->title, 'url' => ['vacancy/view', 'id' => $model->vacancy->vacancy_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->can('deleteRequest')): ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->request_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'last_name',
            'email',
            [
                'attribute' => 'vacancy',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->vacancy->title),['vacancy/view', 'id' => $model->vacancy->vacancy_id]);
                },
            ],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->username),['user/view', 'id' => $model->user->getId()]);
                },
            ],
            'created_at',
            [
                'attribute' => 'resume',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->resume), $model->getResumeLink());
                },
            ],
        ],
    ]) ?>

</div>
