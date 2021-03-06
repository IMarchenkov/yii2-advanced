<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Task */

$this->title = $model->name;

if (!$listView) {
    $this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!$listView): ?>
        <p><?= Html::a(Yii::t('app', 'back'), ['index']) ?></p>
    <?php endif; ?>
    <p>
        <?= Html::a(Yii::t('app', 'update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if ($listView) {
            echo Html::a(Yii::t('app', 'view'), ['view', 'id' => $model->id], [
                'class' => 'btn btn-success',
            ]);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date',
            'description:ntext',
            'user_id',
        ],
    ]) ?>

</div>
