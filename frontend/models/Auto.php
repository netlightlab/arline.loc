<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auto".
 *
 * @property int $id
 * @property int $driver_id
 * @property string $mark
 * @property string $number
 */
class Auto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['driver_id'], 'integer'],
            [['mark', 'number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_id' => 'Driver ID',
            'mark' => 'Mark',
            'number' => 'Number',
        ];
    }
}
