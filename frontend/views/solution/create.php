<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solution */

$this->title = $task->title . ' (Your solution)';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['task/index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($task->title), 'url' => ['task/view', 'id' => $task->task_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'task' => $task
    ]) ?>

</div>
