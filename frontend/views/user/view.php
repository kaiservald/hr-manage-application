<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = "Профіль користувача " . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                <?= Html::img($model->getImage(), ['alt' => 'My logo', 'width' => '100%']) ?>
            </div>

            <div class="col-12 col-sm-3">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [

                        'first_name',
                        'last_name',
                        'email:email',

                    ],
                ]) ?>
            </div>
        </div>
    </div>



</div>
