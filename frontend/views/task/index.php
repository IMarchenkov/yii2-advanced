<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\widgets\ListView;
use frontend\assets\TaskAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaskSearch */
/* @var $modelProject common\models\tables\Project */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Task';
$this->params['breadcrumbs'][] = $this->title;

TaskAsset::register($this);
?>
<div class="tasks-index">
    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <? /* Html::a(Yii::t('app', 'create'), ['create', 'project_id' => $model->project_id], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_unit',
        'viewParams' => [
            'listView' => true,
            'modelProject' => $modelProject
        ]
    ]);
    ?>

</div>
