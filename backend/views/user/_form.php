<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\tables\Role;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\tables\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $roles \common\models\tables\Role[] */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map($roles, 'id', 'name')) ?>

    <?= $form->field($model, 'telegram_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
