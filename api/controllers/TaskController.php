<?php

namespace api\controllers;

use common\models\Authentication;
use common\models\tables\Task;
use common\models\tables\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function ($username, $password) {
                $user = Authentication::findByUsername($username);
                /** @var $user Authentication */
                if (!empty($user) && $user->validatePassword($password)) {
                    return $user;
                }
                return null;
            }
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);

        return $actions;
    }

    public function actionIndex(){
        $tasks = Task::getTaskByUserId();
        return $tasks;
    }

    public function actionView($id)
    {
        $query = Task::find()
            ->where(['id' => $id])
            ->andFilterWhere(
                ['or', ['=', 'responsible_id', \Yii::$app->user->id],
                ['=', 'initiator_id', \Yii::$app->user->id]]
            );

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }


}