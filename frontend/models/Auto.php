<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            'driver_id' => 'Водитель',
            'mark' => 'Марка авто',
            'number' => 'Гос. номер',
        ];
    }

    /**
     * Получить водителей
     * @return array
     * Array( 'id' => 'name surname' )
     */
    public static function getDrivers(){
        $drivers = Driver::find()->asArray()->indexBy('id')->all();

        $result = [];
        foreach($drivers as $driver){
            $result[$driver['id']] = $driver['surname'] . " " . $driver['name'];
        }

        return $result;
    }

    /**
     * Получить имя фамилию водителя по id
     * @return string
     * Имя Фамилия
     */
    public static function getDriverName($id){
        $drivers = Driver::find()->select(['surname','name'])->asArray()->where(['id' => $id])->one();
        if($drivers){
            $result = implode(' ', $drivers);
        }else{
            $result = 'Нет водителя';
        }
        return $result;
    }
}
