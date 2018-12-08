<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\tables\User;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php $users = User::find()->select(['id', 'username'])->all(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map($users, 'id', 'username')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
