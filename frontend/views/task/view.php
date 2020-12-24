<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::encode($model->description) ?></p>
    <table class="table table-bordered">
        <tr>
            <th colspan="2">Requirements</th>
        </tr>
        <tr>
            <th>Function Name</th>
            <td><?= Html::encode($model->function_name) ?></td>
        </tr>
    </table>
    <p class="font-italic text-sm-right">Author: <?= Html::encode($model->username) ?></p>
    <p class="font-italic text-sm-right">Created At: <?= Html::encode($model->created_at) ?> </p>



    <?= Html::a('Send solution', ['solution/create', 'task_id' => $model->task_id], ['class' => 'btn btn-primary']) ?>

</div>
