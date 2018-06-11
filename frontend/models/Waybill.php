<?php

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "waybill".
 *
 * @property int $id
 */
class Waybill extends \yii\db\ActiveRecord
{
    public $date_from;
    public $date_to;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'waybill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auto_id', 'coordinator_id', 'odo_start', 'odo_end', 'passed_km', 'card', 'gsm'], 'integer'],
            [['date', 'time_start', 'time_end'], 'safe'],
            [['odo_start_photo', 'odo_end_photo', 'way', 'gsm_check'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auto_id' => 'Auto ID',
            'date' => 'Date',
            'time_start' => 'Time Start',
            'odo_start' => 'Odo Start',
            'odo_start_photo' => 'Odo Start Photo',
            'time_end' => 'Time End',
            'odo_end' => 'Odo End',
            'odo_end_photo' => 'Odo End Photo',
            'passed_km' => 'Passed Km',
            'way' => 'Way',
            'card' => 'Card',
            'gsm' => 'Gsm',
            'gsm_check' => 'Gsm Check',
        ];
    }
}
