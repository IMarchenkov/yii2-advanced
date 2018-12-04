<?php

namespace common\components\events;

use Yii;
use common\models\tables\User;
use common\models\tables\Task;
use yii\base\Component;
use yii\base\Event;
use yii\web\YiiAsset;

class EventsComponent extends Component
{
    public function init()
    {
        parent::init();

//        self::setLanguage();

        Event::on(Task::class, Task::EVENT_AFTER_INSERT, [TaskEvents::class, 'handlerTaskCreate']);

        Event::on(Task::class, Task::EVENT_AFTER_UPDATE, [TaskEvents::class, 'handlerTaskUpdate']);

  }

    protected static function setLanguage()
    {
        $session = Yii::$app->session;

        $language = $session->get('langauge');
        if (!$language)
            $language = 'ru-Ru';

        $session->set('langauge', $language);
        Yii::$app->language = $language;
    }
}