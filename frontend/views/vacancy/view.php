<?php

use rmrevin\yii\fontawesome\FAS;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vacancy */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Вакансії', 'url' => ['index']];
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
                <?php

                $buttons['view'] = function ($url, $model) {
                    if (Yii::$app->user->can("viewRequest", ["request" => $model])) {
                        return Html::a(FAS::icon('eye'), Url::to(['request/view', 'id' => $model->request_id]), [
                            'title' => "View",
                            "style" => "margin: 3px"
                        ]);
                    }
                };
                $buttons['delete'] = function ($url, $model) {
                    if (Yii::$app->user->can("deleteRequest")) {
                        return Html::a(FAS::icon('trash'), Url::to(['request/delete', 'id' => $model->request_id]), [
                            'title' => "Delete",
                            "style" => "margin: 3px",
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                        ]);
                    }
                };

                ?>
                <?= GridView::widget([
                    'dataProvider' => $requestProvider,
                    'columns' => [
                        'first_name',
                        'last_name',
                        'username',
                        'created_at',
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'template' => '{view} {delete}',
                            'buttons' => $buttons,
                        ],
                    ],
                ]) ?>
            </div>

        </div>

    </div>
</div>
