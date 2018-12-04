<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\Documents;
use frontend\assets\TaskAsset;

use common\modules\chat\Chat;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Task */
/* @var $modelFile common\models\tables\File */
/* @var $modelProject common\models\tables\Project */

$this->title = $model->name;

if (!$listView) {
    $this->params['breadcrumbs'][] = ['label' => 'Task', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
//\yii\web\YiiAsset::register($this);
TaskAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= $modelProject->name?>: <?= Html::encode($this->title) ?></h1>
    <?php if (!$listView): ?>
        <p><?= Html::a(Yii::t('app', 'back'), ['index', 'project_id' => $modelProject->id]) ?></p>
    <?php endif; ?>
    <p>
        <?= Html::a(Yii::t('app', 'update'), ['update', 'project_id' => $modelProject->id, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if ($listView) {
            echo Html::a(Yii::t('app', 'view'), ['view', 'project_id' => $modelProject->id, 'id' => $model->id], [
                'class' => 'btn btn-success',
            ]);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date_start',
            'date_end',
            'description:ntext',
            'responsible_id',
            'initiator_id'
        ],
    ]) ?>

    <?= Documents::widget([
        'documents' => $model->documents
    ]); ?>

</div>

<?php
$chat = Chat::getInstance();
echo Chat::getChat(0);