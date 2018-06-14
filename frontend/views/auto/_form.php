<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Auto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'driver_id')->dropDownList($model::getDrivers()) ?>
<!--    --><?// print_r($model::getDrivers()) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
