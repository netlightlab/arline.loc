<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.06.2018
 * Time: 9:44
 */

namespace frontend\controllers;


use common\models\EmailSender;
use frontend\models\Errors;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\models\Waybill;

class SenderController extends Controller
{
    /**
     * проверяем заполнен ли вечерний пробег
     *
     */
    public function actionCheck()
    {
        $result = $this->getArrayData();

        if(is_array($result)){
            foreach($result as $item){
                $errors = new Errors();
                $errors->date = $item['date'];
                $errors->coordinator = $item['coordinator_id'];
                $errors->car = $item['auto_id'];
                $errors->save(); //записываем эти данные в таблицу errors;
            }
            $this->sendEmail($result);
        }
    }



    /**
     * отправляем email с данными
     *
     * @return boolean
     */
    protected function sendEmail($result){
        $mail = new EmailSender();
        if($mail->sendEmail($result))
            return true;

        return false;
    }

    /**
     * @return array|null
     *
     */
    public function getArrayData()
    {
        $waybills = Waybill::find()
            ->select(['date','coordinator_id','auto_id','odo_start','odo_end'])
            ->asArray()
            ->all();

        $previousDay = date('d-m-Y', strtotime("-1 day"));
        $resultArray = [];
        foreach($waybills as $waybill){
            $date = date_create($waybill['date']);
            $waybill['date'] = date_format($date, 'd-m-Y');
            if($waybill['date'] == $previousDay){
                if(!$waybill['odo_end']){ //проверка если вчера не заполнили показания одометра по приезду
                    $resultArray[] = $waybill; //записываем сюда все вчерашние данные путевых листов
                }
            }
        }

        if($resultArray){
            return $resultArray;
        }else{
            return null;
        }
    }
}