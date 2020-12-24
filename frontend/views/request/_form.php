<?php

use frontend\models\Vacancy;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'vacancy_id')
        ->hiddenInput(['value' => $vacancy->vacancy_id])
        ->label(false); ?>
    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'resume')->fileInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
