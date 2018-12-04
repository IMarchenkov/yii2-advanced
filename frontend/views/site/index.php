<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Start new project'), ['project/create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php //var_dump($dataProvider); die();?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_project_unit',
            'viewParams' => [
                'listView' => true,
            ]
        ]);
        ?>

    <?php Pjax::end(); ?>
</div>
