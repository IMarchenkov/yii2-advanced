<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 02.12.2018
 * Time: 21:59
 */

namespace frontend\controllers;


use common\models\tables\Project;
use yii\web\Controller;
use SonkoDmitry\Yii\TelegramBot\Component;

class TestController extends Controller
{
    public function actionIndex()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);
        $bot->setCurlOption(CURLOPT_SSL_VERIFYHOST, false);
        $bot->setCurlOption(CURLOPT_SSL_VERIFYPEER, false);

        $updates = $bot->getUpdates();
        $messages = [];

        foreach ($updates as $update) {
            $message = $update->getMessage();
            $messages[] = [
                'message' => $message->getText(),
                'username' => $message->getFrom()->getUsername()
            ];
        }
        var_dump($messages);

    }
}