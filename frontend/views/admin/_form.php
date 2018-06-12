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


    <?php
    if($model->odo_start_photo){
        echo Html::a(
            Html::img('@web/common/uploads/' . $model->id . '/' . $model->odo_start_photo,
                ['style' =>
                    ['max-width' => '100px']
                ]),
            [
                \yii\helpers\Url::to(['@web/common/uploads/' . $model->id . '/' . $model->odo_start_photo])
            ], ['data-fancybox' => 'odo_photo']);
    }
    ?>
    <?= $form->field($model, 'odo_start_photo')->fileInput()->label('Файл') ?>

    <?= $form->field($model, 'time_end')->textInput()->label('Время') ?>

    <?= $form->field($model, 'odo_end')->textInput()->label('Показания ODO км, м/ч') ?>


    <?php
    if($model->odo_end_photo){
        echo Html::a(
            Html::img('@web/common/uploads/' . $model->id . '/' . $model->odo_end_photo,
                ['style' =>
                    ['max-width' => '100px']
                ]),
            [
                \yii\helpers\Url::to(['@web/common/uploads/' . $model->id . '/' . $model->odo_end_photo])
            ], ['data-fancybox' => 'odo_photo']);
    }
    ?>
    <?= $form->field($model, 'odo_end_photo')->fileInput()->label('Файл') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php

$this->registerCssFile(\yii\helpers\Url::to(['@web/css/jquery.fancybox.min.css']));
$this->registerJsFile(\yii\helpers\Url::to(['@web/js/jquery.fancybox.min.js']), ['depends' => [\yii\web\JqueryAsset::class]]);

?>
