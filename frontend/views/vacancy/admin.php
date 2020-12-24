<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Мої вакансії";
$this->params['breadcrumbs'][] = ['label' => 'Мої вакансії'];
?>

<h1><?= Html::encode($this->title); ?></h1>

<p>
    <?= Html::a('Створити вакансію', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<section id="continent-view">
    <div class="container">

        <?php
        $buttons['view'] = function ($url, $model) {
            return Html::a(FAS::icon('eye'), $url, [
                'title' => "View",
                "style" => "margin: 3px"
            ]);
        };

        $buttons['update'] = function ($url, $model) {
            return Html::a(FAS::icon('edit'), $url, [
                'title' => "Update",
                "style" => "margin: 3px"
            ]);
        };


        $buttons['delete'] = function ($url, $model) {
            return Html::a(FAS::icon('trash'), $url, [
                'title' => "Delete",
                "style" => "margin: 3px",
                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'data-method' => 'post',
            ]);
        };


        $widget = [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'title',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(Html::encode($model->title), ['view', 'id' => $model->vacancy_id]);
                    },
                ],

                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view}{update}{delete}',
                    'buttons' => $buttons,
                ],
            ],
        ];


        ?>


        <?= GridView::widget($widget); ?>

    </div>
</section>