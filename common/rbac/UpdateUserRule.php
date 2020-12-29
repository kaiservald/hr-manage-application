<?php
namespace common\rbac;

use yii\rbac\Rule;

class UpdateUserRule extends Rule
{
    public $name = 'updateUserRule';

    public function execute($user, $item, $params)
    {
        return isset($params['user']) ? $params['user'] == $user : false;
    }
}