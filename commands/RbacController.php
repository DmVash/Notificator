<?php

namespace app\commands;

use Yii;
use yii\base\Controller;
use yii\console\controllers;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //разрешение для просмотра уведомлений
        $viewNotice = $auth->createPermission('viewNotice');
        $viewNotice->description = 'View notice';
        $auth->add($viewNotice);

        $createNotice = $auth->createPermission('createNotice');
        $createNotice->description = 'Create notice';
        $auth->add($createNotice);

        $updateNotice = $auth->createPermission('updateNotice');
        $updateNotice->description = 'Update notice';
        $auth->add($updateNotice);

        $deleteNotice = $auth->createPermission('deleteNotice');
        $deleteNotice->description = 'Delete notice';
        $auth->add($deleteNotice);

        $viewUsers = $auth->createPermission('viewUsers');
        $viewUsers->description = 'View users';
        $auth->add($viewUsers);

        $banUser = $auth->createPermission('banUser');
        $banUser->description = 'Ban user';
        $auth->add($banUser);

        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create post';
        $auth->add($createPost);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $viewNotice);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $createNotice);
        $auth->addChild($admin, $updateNotice);
        $auth->addChild($admin, $deleteNotice);
        $auth->addChild($admin, $viewUsers);
        $auth->addChild($admin, $banUser);
        $auth->addChild($admin, $createPost);

    }

}