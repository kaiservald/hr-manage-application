<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


    <div class="container">
    <div class="row justify-content-center">
        <div class="col-8 col-sm-4">
            <div class="user-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <?= $form->field($model, 'imageFile')->fileInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
