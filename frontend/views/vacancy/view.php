<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vacancy */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vacancy-view">



    <p>
        <?= Html::a('Відправити запит на роботу', ['request/create', 'vacancy_id' => $model->vacancy_id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->can('updateVacation', ['vacancy' => $model] )): ?>
        <?= Html::a('Редагувати', ['update', 'id' => $model->vacancy_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if (Yii::$app->user->can('admin')): ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->vacancy_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif; ?>
    </p>
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            "label" => 'Status',
                            "value" => $model->status->status_name
                        ],
                        'username',
                        'created_at',
                    ],
                ]) ?>
            </div>
            <div class="col">
                <?= Html::encode($model->description) ?>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <h2>Запити на роботу</h2>
                <?= GridView::widget([
                    'dataProvider' => $requestProvider,
                    'columns' => [
                        [
                            'attribute' => 'vacancy',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a(Html::encode($model->vacancy->title),['vacancy/view', 'id' => $model->vacancy->vacancy_id]);
                            },
                        ],
                        'first_name',
                        'last_name',
                        'username',
                        'created_at',
                    ],
                ]) ?>
            </div>

        </div>

    </div>
</div>
