<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "waybill".
 *
 * @property int $id
 * @property int $auto_id
 * @property string $date
 * @property string $time_start
 * @property int $odo_start
 * @property string $odo_start_photo
 * @property string $time_end
 * @property int $odo_end
 * @property string $odo_end_photo
 * @property int $passed_km
 * @property string $way
 * @property int $card
 * @property int $gsm
 * @property string $gsm_check
 */
class Waybill extends \yii\db\ActiveRecord
{
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
            [['auto_id', 'odo_start', 'odo_end', 'passed_km', 'card', 'gsm'], 'integer'],
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
