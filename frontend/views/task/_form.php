<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\tables\User;
use \yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Task */
/* @var $model common\models\tables\File */
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

    <?php $users = User::find()->select(['id', 'username'])->all(); ?>

    <?php if (!$model->date) $model->date = date('Y-m-d'); ?>

    <?php if (!$model->date_end) $model->date_end = date('Y-m-d'); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::class, [
        'model' => $model,
        'attribute' => 'date',
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

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map($users, 'id', 'username')); ?>

    <?= $form->field($modelFile, 'file[]')->fileInput(['multiple' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
