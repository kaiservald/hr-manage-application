<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = "My Tasks";
$this->params['breadcrumbs'][] = ['label' => 'My Tasks'];
?>

<h1>My Tasks</h1>
<p>
    <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<section id="continent-view">
    <div class="container">


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'title',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(Html::encode($model->title),['view', 'id' => $model->task_id]);
                    },
                ],
                'function_name',
                [
                    'attribute' => 'category',
                    'value' => 'category.name'
                ],

                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(FAS::icon('eye'), $url, [
                                'title' => "View",
                                "style" => "margin: 3px"
                            ]);
                        },

                        'update' => function ($url, $model) {
                            return Html::a(FAS::icon('edit'), $url, [
                                'title' => "Update",
                                "style" => "margin: 3px"
                            ]);
                        },
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