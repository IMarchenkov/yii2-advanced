<?php

use yii\helpers\Html;
use frontend\assets\TaskAsset;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Task */
/* @var $modelUsers common\models\tables\User */
/* @var $modelFile common\models\tables\File */
/* @var $modelProject common\models\tables\Project */

$this->title = 'Update Task: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Task', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

TaskAsset::register($this);
?>
<div class="tasks-update">

    <h1><?= $modelProject->name ?>: <?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUsers' => $modelUsers,
        'modelFile' => $modelFile
    ]) ?>

</div>
