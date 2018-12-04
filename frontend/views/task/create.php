<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var  $model common\models\tables\Task */
/* @var $modelUsers common\models\tables\User */
/* @var $modelFile common\models\tables\File */
/* @var $modelProject common\models\tables\Project */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Task', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= $modelProject->name?>: <?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUsers' => $modelUsers,
        'modelFile' => $modelFile,
    ]) ?>
</div>
