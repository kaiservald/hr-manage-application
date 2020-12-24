<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SolutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solutions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solution-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'task',
                'value' => 'task.title'
            ],
            [
                'attribute' => 'username',
                'value' => 'user.username'
            ],
            'result',
            'created_at',
        ],
    ]); ?>


</div>
