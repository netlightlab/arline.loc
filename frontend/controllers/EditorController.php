<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.06.2018
 * Time: 12:04
 */

namespace frontend\controllers;

use common\models\User;
use frontend\models\Auto;
use frontend\models\Waybill;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\base\Exception;
use Yii;
use yii\web\UploadedFile;

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



        $cars = User::find()->where(['id' => Yii::$app->user->id])->select(['cars'])->one();
        $carsId = unserialize($cars->cars);

        $dataProvider = new ActiveDataProvider([
            'query' => Auto::find()->where(['id' => $carsId]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionWaybill($auto_id) {
        $model = new Waybill();

        Yii::$app->request->queryParams['Waybill']['date_from'] ? $date_from = Yii::$app->request->queryParams['Waybill']['date_from'] : $date_from = date('Y-m-d' ,strtotime('first day of this month'));
        Yii::$app->request->queryParams['Waybill']['date_to'] ? $date_to = Yii::$app->request->queryParams['Waybill']['date_to'] : $date_to = date('Y-m-d' ,strtotime('last day of this month')); //получаем первый и последний дни текущего месяца и делаем фильтр за текущий месяц

        $car = Auto::find()->where(['id' => $auto_id])->one();

        $model->date_from = $date_from;
        $model->date_to = $date_to;

        $dataProvider = new ActiveDataProvider([
            'query' => Waybill::find()
                    ->where(['auto_id' => (int)$auto_id, 'coordinator_id' => Yii::$app->user->id])
                    ->andFilterWhere(['between', 'date', $date_from . ' 00:00:00', $date_to . ' 23:59:59']),
            'pagination' => [
                'pageSize' => date('d',strtotime('last day of this month')) // количество записей в таблице = количеству дней в месяце
            ]
        ]);

        return $this->render('waybill', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'car' => $car,
        ]);
    }

    /**
     * Displays a single Auto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Auto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($auto_id)
    {
        $model = new Waybill();

//        $uCars = unserialize(User::find()->select('cars')->where(['id' => Yii::$app->user->id])->one()->cars);



        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->auto_id = $auto_id;
            $model->coordinator_id = Yii::$app->user->id;
            if($model->odo_end)
                $model->passed_km = $model->odo_end - $model->odo_start;

            /*file upload*/

            $startPhoto = UploadedFile::getInstance($model,'odo_start_photo');
            $endPhoto = UploadedFile::getInstance($model,'odo_end_photo');

            if($startPhoto->name)
                $model->odo_start_photo = $startPhoto->name;

            if($endPhoto->name)
                $model->odo_end_photo = $startPhoto->name;

            $model->save(false);

            if($startPhoto){
                $uploadPath = 'common/uploads/' . $model->id;

                if(!is_dir($uploadPath)){
                    FileHelper::createDirectory($uploadPath);
                }

                $startPhoto->saveAs($uploadPath . '/' . $startPhoto->name);
            }

            if($endPhoto){
                $uploadPath = 'common/uploads/' . $model->id;

                if(!is_dir($uploadPath)){
                    FileHelper::createDirectory($uploadPath);
                }

                $endPhoto->saveAs($uploadPath . '/' . $endPhoto->name);
            }

            /*#file upload*/

            return $this->redirect(Url::to(['waybill', 'auto_id' => Yii::$app->request->get('auto_id')]));
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Auto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public $odo_start_photo;
    public $odo_end_photo;
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->odo_start_photo = $model->odo_start_photo;
        $this->odo_end_photo = $model->odo_end_photo;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(!empty($model->odo_end) && $model->odo_end <= $model->odo_start){
                throw new Exception('test');
            }
            if($model->odo_end){
                $model->passed_km = $model->odo_end - $model->odo_start;
            }



            if($startPhoto = UploadedFile::getInstance($model,'odo_start_photo')){
                $uploadPath = 'common/uploads/' . $model->id;

                if (!is_dir($uploadPath)) {
                    FileHelper::createDirectory($uploadPath);
                }

                if ($startPhoto->saveAs($uploadPath . '/' . $startPhoto->name)) {
                    $model->odo_start_photo = $startPhoto->name;
                }
            }else{
                $model->odo_start_photo = $this->odo_start_photo;
            }


            if($endPhoto = UploadedFile::getInstance($model,'odo_end_photo')){
                $uploadPath = 'common/uploads/' . $model->id;

                if (!is_dir($uploadPath)) {
                    FileHelper::createDirectory($uploadPath);
                }

                if ($endPhoto->saveAs($uploadPath . '/' . $endPhoto->name)) {
                    $model->odo_end_photo = $endPhoto->name;
                }
            }else{
                $model->odo_end_photo = $this->odo_end_photo;
            }





            $model->save(false);

            return $this->redirect(['view', 'id' => $model->id]);

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Auto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
//        если нужно удалять папку с фото тоже
        /*$dir = 'common/uploads/' . $id;
        if(is_dir($dir)){
            FileHelper::removeDirectory($dir);
        }*/


        $this->findModel($id)->delete();
        return $this->goBack();
    }

    /**
     * Finds the Waybill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Waybill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Waybill::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}