<?php

namespace common\widgets;


use yii\jui\Widget;

class Documents extends Widget
{
    public $documents;

    public function run()
    {
        return $this->render("documents", ['documents' => $this->documents]);
    }
}