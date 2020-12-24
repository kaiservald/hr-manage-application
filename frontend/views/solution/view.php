<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solution */

$this->title = $model->task->title;
$this->params['breadcrumbs'][] = ['label' => 'Solutions', 'url' => ['my']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="solution-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->solution_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'solution_id',
            'solution:ntext',
            'created_at',
        ],
    ]) ?>

    <table class="table table-bordered">
        <?php foreach($model->testResultArray['results'] as $key => $resultItem): ?>
        <tr>
            <td>Test # <?= $key ?></td>
            <?php if ($resultItem['message'] == 'Test passed'): ?>
            <td class="alert alert-success" role="alert">
                <?= $resultItem['message'] ?>
            </td>
            <?php else: ?>
                <td class="alert alert-danger" role="alert">
                    <?= $resultItem['message'] ?>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th>Result</th>
            <td><?= $model->testResultArray['result'] * 100 . '%' ?></td>
        </tr>

    </table>
</div>
