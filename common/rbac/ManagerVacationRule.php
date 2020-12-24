<?php
namespace common\rbac;

use yii\rbac\Rule;

class ManagerVacationRule extends Rule
{
    public $name = 'managerVacationRule';

    public function execute($user, $item, $params)
    {
        return isset($params['vacancy']) ? $params['vacancy']->created_by == $user : false;
    }
}