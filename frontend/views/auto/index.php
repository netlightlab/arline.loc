<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Auto;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Autos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Auto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'driver_id',
                'value' => function($e){
                    return Auto::getDriverName($e->driver_id);
                }
            ],
            'mark',
            'number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
