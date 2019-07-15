<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['events'],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'bot' => [
            'class' => SonkoDmitry\Yii\TelegramBot\Component::class,
            'apiToken' => '748752436:AAHDB8nx4XBo_aWTu-dl3f6Con8qsPJoiXI',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'events' => [
            'class' => common\components\events\EventsComponent::class
        ],
    ],
];
