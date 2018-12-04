<?php

namespace frontend\modules\chat\controllers;

use yii\web\Controller;


class ClientController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


}