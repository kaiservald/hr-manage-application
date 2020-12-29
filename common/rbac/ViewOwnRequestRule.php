<?php
namespace common\rbac;

use yii\rbac\Rule;

class ViewOwnRequestRule extends Rule
{
    public $name = 'viewOwnRequestRule';

    public function execute($user, $item, $params)
    {
        return isset($params['request']) ?
            ($params['request']->created_by == $user ||
                $params['request']->vacancy->created_by == $user) : false;
    }
}