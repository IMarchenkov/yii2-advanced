<?php

namespace frontend\modules\chat\commands;

use yii\console\Controller;
use yii\console\ExitCode;

class ServerController extends Controller
{
    public function actionStart()
    {
        echo 'Chat server';
        return ExitCode::OK;
    }
}