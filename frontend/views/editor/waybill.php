<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.06.2018
 * Time: 17:24
 */

use kartik\grid\GridView;
use frontend\models\Auto;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>

<?= \yii\helpers\Html::a('Создать', \yii\helpers\Url::to(['create', 'auto_id' => Yii::$app->request->get('auto_id')]), ['class' => 'btn btn-primary']) ?>


<div style="padding: 30px 0 0; font-size: 2rem">
<p>Марка автомобиля: <?= $car->mark ?></p>
<p>Гос/сер.: <?= $car->number ?></p>
</div>

<?php Pjax::begin(['id' => 'waybills']) ?>

<div style="padding: 30px 0;">
<? $form = ActiveForm::begin([
    'method' => 'GET',
    'enableAjaxValidation' => true,
//    'action' => '',
    'options' => [
        'data-pjax' => true,
        'enctype' => 'multipart/form-data',
        'class' => 'form-inline'
    ]
]); ?>
<!--    <i class="glyphicon glyphicon-calendar"></i>-->
<?= $form->field($model, 'date_from')->widget(\yii\jui\DatePicker::class, [
    'dateFormat' => 'yyyy-MM-dd'
])->label('Период с') ?>
<?= $form->field($model, 'date_to')->widget(\yii\jui\DatePicker::class, [
    'dateFormat' => 'yyyy-MM-dd',
])->label('по') ?>
<?= \yii\helpers\Html::submitButton('Фильтр', ['class' => 'btn btn-primary']) ?>

<? ActiveForm::end() ?>
</div>

<?php
echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'columns' => [
//        'filter' => \yii\jui\DatePicker::widget([
//            'model'=>$searchModel,
//            'attribute'=>'date',
//            'language' => 'ru',
//                'dateFormat' => 'dd-MM-yyyy',
//        ]),
        [
            'attribute' => 'date',
            'format' => ['date', 'dd-MM-Y'],
        ],
        [
            'header' => 'Ф.И.О водителя',
            'value' => function($e) {
                return Auto::getDriverName(Auto::find()->where(['id' => Yii::$app->request->get('auto_id')])->select('driver_id')->one());
            },
        ],
        [
            'attribute' => 'time_start',
        ],
        [
            'attribute' => 'odo_start'
        ],
        [
            'attribute' => 'time_end'
        ],
        [
            'attribute' => 'odo_end'
        ],
        [
            'attribute' => 'passed_km'
        ],
        [
            'attribute' => 'way'
        ],
        [
            'attribute' => 'card'
        ],
        [
            'attribute' => 'gsm'
        ],
        ['class' => 'yii\grid\ActionColumn'],

    ],
    'beforeHeader'=>[
        [
            'columns'=>[
                [],
                [],
                ['content'=>'Выезд', 'options'=>['colspan'=>2, 'class'=>'text-center ']],
                ['content'=>'Возвращение', 'options'=>['colspan'=>2, 'class'=>'text-center ']],
                [],[],[],[],[]
            ],
            'options'=>['class'=>'skip-export'] // remove this row from export
        ]
    ],
    'responsive'=>true,
    'hover'=>true
]);
?>
<?php Pjax::end() ?>
