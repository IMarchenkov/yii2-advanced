<?php

use yii\helpers\Html;

/* @var $model common\models\tables\Project */

$this->registerCssFile('@web/css/task/style.css');
?>
<?= Html::a($model->name, ['project/view', 'id' => $model->id], ['class' => 'project-title']) ?>
<div class="project-block">
    <?php foreach ($model->tasks as $task): ?>

        <?= $this->render('_task_unit', ['model' => $task]) ?>

    <?php endforeach; ?>
    <?= $this->render('_task_unit', ['project_id' => $model->id]) ?>
</div>
