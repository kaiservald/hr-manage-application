<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Solution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solution-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'task_id')
        ->hiddenInput(['value' => $task->task_id])
        ->label(false); ?>
    <?= $form->field($model, 'solution')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
