<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Auto;

/* @var $this yii\web\View */
/* @var $model frontend\models\Auto */

$this->params['breadcrumbs'][] = ['label' => 'Autos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Гос. номер',
                'value' => function($e) {
                    $auto = Auto::find()->select('number')->where(['id' => $e->auto_id])->one();
                    return $auto->number;
                },
            ],
            [
                'label' => 'ФИО',
                'value' => function($e) {
                    return Auto::getDriverName(Auto::find()->where(['id' => $e->auto_id])->select('driver_id')->one());
                },
            ],
            'date',
            'time_start',
            'odo_start',
            'odo_start_photo',
            'time_end',
            'odo_end',
            'odo_end_photo',
            'passed_km',
            'way',
            'card',
            'gsm',
            'gsm_check',
        ],
    ]) ?>
</div>
