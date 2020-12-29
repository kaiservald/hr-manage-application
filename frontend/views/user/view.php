<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = "Профіль користувача " . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Користувачі', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>



    <div class="container">

        <div class="row justify-content-center">
            <div class="col-7 col-sm-3">
                <?= Html::img($model->getImage(), ['alt' => 'My logo', 'width' => '100%', 'class' => 'border']) ?>
                <?php if (Yii::$app->user->can('updateUser', ['user' => $model->getId()])): ?>
                <?= Html::a('Редагувати зображення', ['update-image', 'id' => $model->id], ['class' => 'btn btn-primary mt-2']) ?>
                <?php endif; ?>
            </div>


            <div class="col-7 col-sm-4">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [

                        'first_name',
                        'last_name',
                        'email:email',
                        [
                            'attribute' => 'role',
                            'value' => function ($data) {
                                return $data->getRole();
                            },
                        ],

                    ],
                ]) ?>
                <?php if (Yii::$app->user->can('updateUser', ['user' => $model->getId()])): ?>
                <?= Html::a('Редагувати профіль', ['update', 'id' => $model->id], ['class' => 'btn btn-primary mt-2']) ?>
                <?php endif; ?>
            </div>
        </div>

    </div>



</div>
