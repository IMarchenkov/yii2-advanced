<?php
namespace common\components\telegram;


class Bot
{
    public static function getBot()
    {
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);
        $bot->setCurlOption(CURLOPT_SSL_VERIFYHOST, false);
        $bot->setCurlOption(CURLOPT_SSL_VERIFYPEER, false);

        return $bot;
    }
}