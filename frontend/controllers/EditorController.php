<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.06.2018
 * Time: 12:04
 */

namespace frontend\controllers;

use common\models\User;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class EditorController extends Controller
{
    public $layout = 'editor';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'editor'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(){
        return $this->render('index');
    }
}