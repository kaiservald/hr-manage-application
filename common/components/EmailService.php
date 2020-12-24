<?php
namespace common\components;

use Yii;
use yii\base\Component;

class EmailService extends Component
{
    public function notifyUser(UserNotificationInterface $event)
    {
        Yii::$app->mailer->compose(
            ['html' => 'register-html', 'text' => 'register-text'],
            ['user' => $event->getName(), 'date' => date('Y-m-d h:i:s')]
        )
            ->setFrom('alemcleod@gmail.com')
            ->setTo($event->getEmail())
            ->setSubject($event->getSubject())
            ->send();
    }

    public function notifyAdmin(UserNotificationInterface $event)
    {
        Yii::$app->mailer->compose()
            ->setFrom('alemcleod@gmail.com')
            ->setTo('alemcleod@gmail.com')
            ->setSubject($event->getSubject())
            ->setTextBody("New User Registered")
            ->send();
    }
}