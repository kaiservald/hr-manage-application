<?php

use frontend\models\Category;
use yii\bootstrap4\Button;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(
                        Category::find()->asArray()->all(), 'category_id', 'name'
                )) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'function_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'function_description')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <h2>Tests</h2>
        </div>
        <?php for ($i = 0; $i <= 9; $i++): ?>
        <div class="row">
            <div class="col-12"><h3>Test <?= Html::encode($i); ?></h3></div>
            <div class="col-6">
                <?= $form->field($model, 'args['. $i . ']')->textInput() ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'result['. $i . ']')->textInput() ?>
            </div>
        </div>
        <?php endfor; ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
