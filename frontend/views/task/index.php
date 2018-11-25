<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\widgets\ListView;
use frontend\assets\TaskAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Task';
$this->params['breadcrumbs'][] = $this->title;

TaskAsset::register($this);
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_unit',
        'viewParams' => [
            'listView' => true,
        ]
    ]);

    ?>

    <?php Pjax::end(); ?>
</div>
