<?php


namespace common\components;


interface UserNotificationInterface
{
    public function getSubject();
    public function getEmail();
    public function getName();
}