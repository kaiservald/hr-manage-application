<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Користувачі';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1><?= Html::encode($this->title) ?></h1>


            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php
            $buttons['update'] = function ($url, $model) {
                if (Yii::$app->user->can("updateUser", ["user" => $model->getId()])) {
                    return Html::a(FAS::icon('edit'), $url, [
                        'title' => "Update",
                        "style" => "margin: 3px"
                    ]);
                }
            };
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'image',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::img($data->getImage(),
                                ['width' => '70px']);
                        },
                    ],
                    [
                        'attribute' => 'username',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(Html::encode($model->username), ['view', 'id' => $model->id]);
                        },
                    ],
                    'first_name',
                    'last_name',
                    [
                        'attribute' => 'role',
                        'value' => function ($data) {
                            return $data->getRole();
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{update}',
                        'buttons' => $buttons,
                    ],

                ],
            ]); ?>
        </div>
    </div>


</div>
