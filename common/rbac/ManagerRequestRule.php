<?php
namespace common\rbac;

use yii\rbac\Rule;

class ManagerRequestRule extends Rule
{
    public $name = 'managerRequestRule';

    public function execute($user, $item, $params)
    {
        return isset($params['request']) ? $params['request']->vacation->created_by == $user : false;
    }
}