<?php

use yii\helpers\Html;

/* @var $model common\models\tables\Task */
/* @var $modelProject common\models\tables\Project */
?>
<div class="task-unit" id="<?= $model->id ?>">
    <div class="task-unit-header">
        <div class="task-date"><?= $model->date_start ?></div>
    </div>
    <div class="task-unit-middle">
        <h2><?= $model->name ?></h2>
    </div>
    <div class="task-unit-footer">
        <?= Html::a(Yii::t('app', 'update'), ['project_id' => $modelProject->id, 'update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'view'), ['project_id' => $modelProject->id, 'view', 'id' => $model->id], [
            'class' => 'btn btn-success',
        ]); ?>
    </div>
</div>