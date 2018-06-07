<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'status')->textInput() ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

<?// print_r(unserialize($model->cars)) ?>

<!--    --><?//= $form->field($model, 'cars')->checkboxList($cars)->label('asd'); ?>

    <?= Html::checkboxList('User[cars][]', unserialize($model->cars), $cars) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
