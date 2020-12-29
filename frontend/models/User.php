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

    public function getRole()
    {
        $roles = array_keys(Yii::$app->authManager->getRolesByUser($this->id));
        return join(", ", $roles);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'first_name' => 'Ім\'я',
            'last_name' => 'Прізвище',
            'email' => 'Email',
            'role' => "Роль",
            'image' => "Зображення",
            'username' => "Логін",
        ];
    }
}