<?php

/* @var $this yii\web\View */


use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>HR Manager</h1>
        <p><a class="btn btn-lg btn-success" href="<?= Url::to('vacancy/index'); ?>">Переглянути список вакансій</a></p>
    </div>
    <div class="body-content text-center">

        <div class="row">
            <div class="col-lg-4">
                <h4>Користувачі</h4>
                <ul class="text-left">
                    <li>Реєстрація</li>
                    <li>Автентифікація</li>
                    <li>Пошук та перегляд вакансій</li>
                    <li>Надсилання запитів на роботу</li>
                    <li>Перегляд надісланих запитів та їх стану</li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h4>Менеджери</h4>
                <ul class="text-left">
                    <li>Створення вакансій</li>
                    <li>Редагування власних вакансій</li>
                    <li>Обробка надісланих запитів від користувачів на власні вакансії</li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h4>Адміністратори</h4>
                <ul class="text-left">
                    <li>Редагування всіх вакансій</li>
                    <li>Обробка всіх запитів</li>
                    <li>Видалення вакансій та запитів</li>
                </ul>
            </div>
        </div>

    </div>
    </div>
</div>
