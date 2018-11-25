<?php

use yii\helpers\Html;
?>
<div class="task-unit" id="<?= $model->id ?>">
    <div class="task-unit-header">
        <div class="task-date"><?= $model->date ?></div>
    </div>
    <div class="task-unit-middle">
        <h2><?= $model->name ?></h2>
    </div>
    <div class="task-unit-footer">
        <?= Html::a(Yii::t('app', 'update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'view'), ['view', 'id' => $model->id], [
            'class' => 'btn btn-success',
        ]); ?>
    </div>
</div>