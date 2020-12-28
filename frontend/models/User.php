<?php


namespace frontend\models;


use Yii;

class User extends \common\models\User
{
    public function getImage()
    {
        if (empty($this->image) ||
            !is_file(Yii::getAlias("@frontend") . '/web/images/user/' . $this->image)) {
            return '/images/placeholder-male.png';
        }
        return '/images/user/' . $this->image;
    }
}