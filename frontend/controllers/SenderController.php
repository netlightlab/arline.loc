<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.06.2018
 * Time: 9:44
 */

namespace frontend\controllers;


use common\models\EmailSender;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\models\Waybill;

class SenderController extends Controller
{
    /**
     * проверяем пробег вечером предыдущего дня и сравниваем с утром
     *
     * @return boolean
     */
    public function actionCheck()
    {
        $waybills = Waybill::find()
            ->select(['date','auto_id','odo_start','odo_end'])
            ->asArray()
            ->all();

        $previousDay = date('d-m-Y', strtotime("-1 day"));
        $resultArray = [];
        foreach($waybills as $waybill){
            $date = date_create($waybill['date']);
            $waybill['date'] = date_format($date, 'd-m-Y');
            if($waybill['date'] == $previousDay){
                if(!$waybill['odo_end']){ //проверка если вчера не заполнили показания одометра по приезду
                    echo 'error';
                    $resultArray[] = $waybill; //записываем сюда все вчерашние данные путевых листов
                }
            }
        }

        return true;
    }



    /**
     * отправляем email с данными
     *
     * @return boolean
     */
    protected function sendEmail(){
        $mail = new EmailSender();

        return true;
    }
}