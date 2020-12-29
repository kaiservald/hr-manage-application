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
                return Html::a(FAS::icon('trash'), $url, [
                    'title' => "Delete",
                    "style" => "margin: 3px",
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                ]);
            }
        };

        ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'vacancy',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(Html::encode($model->vacancy->title),['vacancy/view', 'id' => $model->vacancy->vacancy_id]);
                    },
                ],
                'created_at',
                'resume',
                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'template' => '{view}{delete}',
                    'buttons' => $buttons,
                ],

            ],
        ]); ?>


    </div>
</section>