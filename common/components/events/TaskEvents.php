<?php

namespace common\components\events;

use common\models\tables\Message;
use Yii;
use yii\base\Event;
use common\models\tables\Task;
use common\models\tables\User;

class TaskEvents
{
    const TASK_CREATE = 'task create';
    const TASK_UPDATE = 'task update';

    public static function handlerTaskCreate(Event $event)
    {
        /** @var Task $model */
        $model = $event->sender;
        $users_id = $model->getUsedUsersId();

        foreach ($users_id as $user_id) {

            $user = User::findOne($user_id);

            $message = 'Hello there is a new task for you <b>' . $model->name . '</b> do it until ' . $model->date_end . ' plz. <a href="http://front.task.local/1/task/' . $model->id . '">Read more...</a>';

            if (!empty($user->email)) {

                $emailMessage = new Message(
                    [
                        'type' => Message::MESSAGE_TYPE_EMAIL,
                        'event' => self::TASK_CREATE,
                        'recipient' => $user->email,
                        'text' => $message
                    ]
                );

                $emailMessage->save();
            }

            if (!empty($user->telegram_id)) {

                $telegramMessage = new Message([
                    'type' => Message::MESSAGE_TYPE_TELEGRAM,
                    'event' => self::TASK_CREATE,
                    'recipient' => $user->telegram_id,
                    'text' => $message
                ]);

                $telegramMessage->save();
            }
        }
    }

    public static function handlerTaskUpdate(Event $event)
    {
        /** @var Task $model */
        $model = $event->sender;
        $users_id = $model->getUsedUsersId();

        foreach ($users_id as $user_id) {

            $user = User::findOne($user_id);

            $message = 'Hello the task <b>' . $model->name . '</b> was updated ' . $model->date_end . '. <a href="http://front.task.local/1/task/' . $model->id . '">Read more...</a>';

            if (!empty($user->email)) {

                $emailMessage = new Message(
                    [
                        'type' => Message::MESSAGE_TYPE_EMAIL,
                        'event' => self::TASK_UPDATE,
                        'recipient' => $user->email,
                        'text' => $message
                    ]
                );

                $emailMessage->save(false);
            }

            if (!empty($user->telegram_id)) {

                $telegramMessage = new Message([
                    'type' => Message::MESSAGE_TYPE_TELEGRAM,
                    'event' => self::TASK_UPDATE,
                    'recipient' => $user->telegram_id,
                    'text' => $message
                ]);

                $telegramMessage->save(false);
            }
        }
    }
}