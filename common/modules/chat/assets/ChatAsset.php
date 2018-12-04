<?php

namespace frontend\modules\chat\assets;

use yii\web\AssetBundle;

class ChatAsset extends AssetBundle
{
    public $sourcePath = '@chat/static';
//    public $baseUrl = '@web/chat';
    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/script.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}