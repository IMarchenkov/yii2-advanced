<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\tables\User;
use \yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Task */
/* @var $modelUsers common\models\tables\User */
/* @var $modelFile common\models\tables\File */
/* @var $modelProject common\models\tables\Project */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(
    "$('#tasks-date').on('change', function(){
        var date = $('#tasks-date').val();
            if($('#tasks-date_end').val() < date){
                 $('#tasks-date_end').val(date);
                 $('#tasks-date_end').attr('value', date);
            }
        });"
);
?>

<div class="tasks-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->date_start) $model->date_start = date('Y-m-d'); ?>

    <?php if (!$model->date_end) $model->date_end = date('Y-m-d'); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_start')->widget(DatePicker::class, [
        'model' => $model,
        'attribute' => 'date_start',
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => ['minDate' => '+0',],
    ]); ?>

    <?= $form->field($model, 'date_end')->widget(DatePicker::class, [
        'model' => $model,
        'attribute' => 'date_end',
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => ['minDate' => '+0',],
    ]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'responsible_id')->dropDownList(\yii\helpers\ArrayHelper::map($modelUsers, 'id', 'username')); ?>

    <?= $form->field($modelFile, 'file[]')->fileInput(['multiple' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
