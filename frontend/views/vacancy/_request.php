<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<a href="<?= Url::to(['request/view', 'id' => $model->request_id]); ?>" class="list-group-item list-group-item-action">
    <?= Html::encode($model->username) ?>
</a>

