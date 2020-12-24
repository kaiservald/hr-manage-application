<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = "Мої запити на роботу";
$this->params['breadcrumbs'][] = ['label' => 'Мої запити на роботу'];
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
        ]); ?>


    </div>
</section>