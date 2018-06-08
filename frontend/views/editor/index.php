<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.06.2018
 * Time: 16:41
 */

//use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use kartik\grid\GridView;
use kartik\grid\FormulaColumn;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h2 class="m-0 p-0">Выберите машину:</h2>

<div class="auto_list">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'number',
            'mark',
            [
                'header' => 'Link',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Перейти', Url::to(['waybill', 'auto_id' => $model->id]), ['class' => 'auto_link']);
                }
            ]
        ],
    ]); ?>
</div>
