<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.06.2018
 * Time: 9:42
 */

namespace common\models;


use frontend\models\Auto;
use common\models\User;
use yii\base\Model;
use Yii;

class EmailSender extends Model
{
    public $toEmail = 'igor@netlight.kz';
    public $subject = 'Ошибка';
    public $body;

    public function sendEmail($result)
    {

        foreach($result as $item){
            $coordinator = User::find()->select('fio')->where(['id' => $item['coordinator_id']])->one();
            $car = Auto::find()->select(['mark','number'])->where(['id' => $item['auto_id']])->one();


            $this->body .= 'Фио: '.$coordinator->fio
                . ' Автомобиль: ' . $car->mark
                .' '. $car->number
                . ' Дата: ' . $item['date']
                . '<br>';
        }

        return Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['supportEmail'])
                ->setTo($this->toEmail)
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
    }
}