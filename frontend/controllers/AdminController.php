<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.06.2018
 * Time: 12:04
 */

namespace frontend\controllers;

use frontend\models\Waybill;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use Yii;
use frontend\models\Auto;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class AdminController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Auto::find()
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionWaybill($auto_id) {
        $dataProvider = new ActiveDataProvider([
            'query' => Waybill::find()->where(['auto_id' => (int)$auto_id]),
        ]);


        return $this->render('waybill', [
            'dataProvider' => $dataProvider,
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

            return $this->redirect(['waybill-view', 'id' => $model->id]);

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Auto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionWaybillView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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