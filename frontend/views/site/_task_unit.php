<?php

use yii\helpers\Html;

/* @var $model common\models\tables\Task */

?>

<?php if (!empty($model)):?>
<div class="task-unit" id="<?= $model->id ?>">
    <div class="task-unit-header">
        <div class="task-date"><?= $model->date_start ?></div>
    </div>
    <div class="task-unit-middle">
        <p><?= $model->name ?></p>
    </div>
    <div class="task-unit-footer">
        <?= Html::a(Yii::t('app', 'update'), ['task/update', 'project_id' => $model->project_id, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'delete'), ['task/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'view'), ['project_id' => $model->project_id, 'task/view',  'id' => $model->id], [
            'class' => 'btn btn-success',
        ]); ?>
    </div>
</div>
<?php elseif ($project_id):?>
    <div class="task-unit" id="new_<?=$project_id ?>">
        <?= Html::a('Создать новую задачу', ['project_id' => $project_id, 'task/create'], [
            'class' => 'btn btn-success',
        ]); ?>
    </div>
<?php endif;?>