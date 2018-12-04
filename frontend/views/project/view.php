<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerCssFile('@web/css/task/style.css');
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?=$model->description?></p>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="project-block">
        <?php foreach ($model->tasks as $task): ?>

            <?= $this->render('//site/_task_unit', ['model' => $task]) ?>

        <?php endforeach; ?>
        <?= $this->render('//site/_task_unit', ['project_id' => $model->id]) ?>
    </div>

</div>
