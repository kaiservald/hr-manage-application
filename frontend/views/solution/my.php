<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = "My Solutions";
$this->params['breadcrumbs'][] = ['label' => 'My Solutions'];
?>

<h1><?= Html::encode($this->title) ?></h1>

<section id="continent-view">
    <div class="container">


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'task',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(Html::encode($model->task->title),['task/view', 'id' => $model->task->task_id]);
                    },
                ],
                [
                    'attribute' => 'solution',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a("Solution",['view', 'id' => $model->solution_id]);
                    },
                ],
                [
                    'attribute' => 'username',
                    'value' => 'user.username'
                ],
                'result',
                'created_at',

                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a(FAS::icon('trash'), $url, [
                                'title' => "Delete",
                                "style" => "margin: 3px",
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                            ]);
                        }

                    ],

                ],
            ],
        ]); ?>


    </div>
</section>