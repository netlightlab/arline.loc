<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.06.2018
 * Time: 17:24
 */

use kartik\grid\GridView;
use frontend\models\Auto;
?>

<?= \yii\helpers\Html::a('Create', \yii\helpers\Url::to(['create', 'auto_id' => Yii::$app->request->get('auto_id')]), ['class' => 'btn btn-primary']) ?>

<?php
echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'date',
        ],
        [
            'header' => 'fio',
            'value' => function($e) {
                return Auto::getDriverName(Auto::find()->where(['id' => Yii::$app->request->get('auto_id')])->select('driver_id')->one());
            },
        ],
        [
            'attribute' => 'time_start'
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
            'header' => 'way'
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
//                ['content' => 'Дата', 'options' => ['rowspan' => 2, 'class'=>'text-center warning']],
                [],
                [],
                ['content'=>'Выезд', 'options'=>['colspan'=>2, 'class'=>'text-center ']],
                ['content'=>'Заезд', 'options'=>['colspan'=>2, 'class'=>'text-center ']],
                [],[],[],[],[]
            ],
            'options'=>['class'=>'skip-export'] // remove this row from export
        ]
    ],
    'responsive'=>true,
    'hover'=>true
]);
?>
