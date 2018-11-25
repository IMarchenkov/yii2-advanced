<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\tables\File */

$this->title = 'Create File';
$this->params['breadcrumbs'][] = ['label' => 'File', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
