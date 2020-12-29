<?php
namespace console\controllers;

use common\rbac\ManagerRequestRule;
use common\rbac\ManagerVacationRule;
use common\rbac\UpdateUserRule;
use common\rbac\ViewOwnRequestRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        #region створення ролей
        $authUser = $auth->createRole('authUser');
        $manager = $auth->createRole('manager');
        $admin = $auth->createRole('admin');
        $auth->add($authUser);
        $auth->add($manager);
        $auth->add($admin);
        $auth->addChild($manager, $authUser);
        $auth->addChild($admin, $manager);
        #endregion

        #region створення дозволів для вакансії
        $createVacation = $auth->createPermission('createVacation');
        $createVacation->description = 'Create a vacation';
        $auth->add($createVacation);

        $updateVacation = $auth->createPermission('updateVacation');
        $updateVacation->description = 'Update vacation';
        $auth->add($updateVacation);

        $deleteVacation = $auth->createPermission('deleteVacation');
        $updateVacation->description = 'Delete vacation';
        $auth->add($deleteVacation);
        #endregion

        #region створення дозволів для запитів
        $createRequest = $auth->createPermission('createRequest');
        $createRequest->description = 'Create a request';
        $auth->add($createRequest);

        $updateRequest = $auth->createPermission('updateRequest');
        $updateRequest->description = 'Update Request';
        $auth->add($updateRequest);

        $deleteRequest = $auth->createPermission('deleteRequest');
        $deleteRequest->description = 'Delete Request';
        $auth->add($deleteRequest);
        #endregion

        #region додавання дозволів до ролей
        $auth->addChild($authUser, $createRequest);
        $auth->addChild($manager, $createVacation);
        $auth->addChild($admin, $updateVacation);
        $auth->addChild($admin, $deleteVacation);
        $auth->addChild($admin, $updateRequest);
        $auth->addChild($admin, $deleteRequest);
        #endregion

        #region призначення ролей користувачам
        $auth->assign($admin, 1);
        $auth->assign($manager, 2);
        $auth->assign($manager, 3);
        $auth->assign($authUser, 4);
        #endregion
    }

    public function actionManagerVacationRule()
    {
        $auth = Yii::$app->authManager;
        $rule = new ManagerVacationRule;
        $auth->add($rule);

        $updateOwnVacation = $auth->createPermission('updateOwnVacation');
        $updateOwnVacation->description = 'Update own vacation';
        $updateOwnVacation->ruleName = $rule->name;
        $auth->add($updateOwnVacation);

        $updateVacation = $auth->getPermission("updateVacation");
        $auth->addChild($updateOwnVacation, $updateVacation);

        $manager = $auth->getRole("manager");
        $auth->addChild($manager, $updateOwnVacation);
    }

    public function actionManagerRequestRule()
    {
        $auth = Yii::$app->authManager;
        $rule = new ManagerRequestRule;
        $auth->add($rule);

        $updateRequestOwnVacation = $auth->createPermission('updateRequestOwnVacation');
        $updateRequestOwnVacation->description = 'Update request for own vacation';
        $updateRequestOwnVacation->ruleName = $rule->name;
        $auth->add($updateRequestOwnVacation);

        $updateRequest = $auth->getPermission("updateRequest");
        $auth->addChild($updateRequestOwnVacation, $updateRequest);

        $manager = $auth->getRole("manager");
        $auth->addChild($manager, $updateRequestOwnVacation);
    }

    public function actionUpdateUser()
    {
        $auth = Yii::$app->authManager;
        $rule = new UpdateUserRule();
        $auth->add($rule);

        $updateUser = $auth->createPermission('updateUser');
        $updateOwnProfile = $auth->createPermission('updateOwnProfile');
        $updateOwnProfile->ruleName = $rule->name;

        $auth->add($updateUser);
        $auth->add($updateOwnProfile);
        $auth->addChild($updateOwnProfile, $updateUser);
    }

    public function actionAssignUpdateUser()
    {
        $auth = Yii::$app->authManager;

        $updateUser = $auth->getPermission('updateUser');
        $updateOwnProfile = $auth->getPermission('updateOwnProfile');
        $admin = $auth->getRole("admin");
        $authUser = $auth->getRole("authUser");
        $auth->addChild($admin, $updateUser);
        $auth->addChild($authUser, $updateOwnProfile);
    }

    public function actionViewRequest()
    {
        $auth = Yii::$app->authManager;
        $rule = new ViewOwnRequestRule();
        $auth->add($rule);

        $viewRequest = $auth->createPermission('viewRequest');
        $viewOwnRequest = $auth->createPermission('viewOwnRequest');
        $viewOwnRequest->ruleName = $rule->name;

        $auth->add($viewRequest);
        $auth->add($viewOwnRequest);
        $auth->addChild($viewOwnRequest, $viewRequest);

        $admin = $auth->getRole("admin");
        $authUser = $auth->getRole("authUser");

        $auth->addChild($admin, $viewRequest);
        $auth->addChild($authUser, $viewOwnRequest);

    }

}