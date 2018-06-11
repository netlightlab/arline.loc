<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "errors".
 *
 * @property int $id
 * @property int $coordinator
 * @property int $car
 * @property string $date
 */
class Errors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'errors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coordinator', 'car'], 'integer'],
            [['date'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coordinator' => 'Coordinator',
            'car' => 'Car',
            'date' => 'Date',
        ];
    }
}
