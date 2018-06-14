<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Путевые листы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a('Create Driver', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
