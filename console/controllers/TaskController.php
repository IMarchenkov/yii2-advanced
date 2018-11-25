<?php

namespace console\commands;

use common\models\tables\Task;
use yii\console\ExitCode;
use yii\helpers\Console;
use yii\console\Controller;
use Yii;

class TaskController extends Controller
{
    public function actionDeadline()
    {
        $tasks = Task::getDeadlineTasks();
        $count = count($tasks);
        Console::startProgress(1, $count);
        foreach ($tasks as $index => $task) {
//            echo .PHP_EOL;
            $user = $task->user;
            $message = 'Mr(s) ' . $user->username . ' task "' . $task->name . '" will be expired tomorrow ' . $task->date_end;

            Yii::$app->mailer->compose()
                ->setFrom('test@testmail.org')
                ->setTo($user->email)
                ->setSubject('Deadline for "' . $task->name.'"')
                ->setTextBody($message)
                ->send();

            Console::updateProgress($index, $count);
        }
        Console::endProgress(0);

        $this->stdout($count.' was sent.'.PHP_EOL, Console::FG_GREEN);

        return ExitCode::OK;
    }
}