<?php

namespace console\controllers;

use common\components\telegram\Bot;
use yii\console\Controller;
use SonkoDmitry\Yii\TelegramBot\Component;


class TelegramController extends Controller
{
    public function actionReceive()
    {
        /** @var Component $bot */
        $bot = Bot::getBot();

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

    public function actionSend($user, $message)
    {
        $bot = Bot::getBot();

        $bot->sendMessage($user, $message);
    }

}