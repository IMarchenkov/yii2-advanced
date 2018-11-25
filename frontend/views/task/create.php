<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\tables\Task */
/* @var $model common\models\tables\File */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Task', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelFile' => $modelFile
    ]) ?>
</div>
