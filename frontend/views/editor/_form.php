<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Auto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'time_start')->textInput()->label('Время') ?>

    <?= $form->field($model, 'odo_start')->textInput()->label('Показания ODO км, м/ч') ?>

    <?= $form->field($model, 'odo_start_photo')->fileInput()->label('Файл') ?>

    <?= $form->field($model, 'time_end')->textInput()->label('Время') ?>

    <?= $form->field($model, 'odo_end')->textInput()->label('Показания ODO км, м/ч') ?>

    <?= $form->field($model, 'odo_end_photo')->fileInput()->label('Файл') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
