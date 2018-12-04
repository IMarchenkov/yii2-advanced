<?php

namespace console\controllers;

use common\models\tables\Message;
use common\components\telegram\Bot;
use SonkoDmitry\Yii\TelegramBot\Component;
use yii\console\ExitCode;
use yii\db\Exception;
use yii\helpers\Console;
use yii\console\Controller;
use Yii;


class EventMessageController extends Controller
{
    const MESSAGE_SEND_SUCCESS = 'success';
    const MESSAGE_SEND_ERROR = 'error';

    public function actionSendAll()
    {
        $messages = Message::find()
            ->andWhere(['like', 'status', 'ready'])
            ->all();

        foreach ($messages as $message) {

            switch ($message->type) {
                case Message::MESSAGE_TYPE_EMAIL:
                    $res = Yii::$app->mailer->compose()
                        ->setFrom('test@testmail.org')
                        ->setTo($message->recipient)
                        ->setSubject('Created new task for you ' . $message->subject)
                        ->setTextBody($message->text)
                        ->send();

                    if ($res === true) {
                        $status = self::MESSAGE_SEND_SUCCESS;
                    } else {
                        $status = self::MESSAGE_SEND_ERROR;
                        $errorMessage = $res;
                    }
                    break;

                case Message::MESSAGE_TYPE_TELEGRAM:

                    /** @var Component $bot */
                    $bot = Bot::getBot();
                    try {
                        $bot->sendMessage($message->recipient, $message->text);
                    } catch (\Exception $e) {
                        $res = self::MESSAGE_SEND_ERROR;
                        $errorMessage = $e->getMessage();
                    }

                    break;
            }

            if ($status == self::MESSAGE_SEND_SUCCESS){
                $message->status = Message::MESSAGE_STATUS_SUCCESS;
                $message->save(false);
            } elseif ($status == self::MESSAGE_SEND_ERROR){
                $message->status = self::MESSAGE_SEND_ERROR;
                $message->error = $errorMessage;
                $message->save(false);
            }
        }
    }
}