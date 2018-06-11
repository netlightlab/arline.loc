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
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\base\Exception;
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
        $date_from = Yii::$app->request->queryParams['Waybill']['date_from'];
        $date_to = Yii::$app->request->queryParams['Waybill']['date_to'];
        $car = Auto::find()->where(['id' => $auto_id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => Waybill::find()
                    ->where(['auto_id' => (int)$auto_id, 'coordinator_id' => Yii::$app->user->id])
                    ->andFilterWhere(['between', 'date', $date_from . ' 00:00:00', $date_to . ' 23:59:59']),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('waybill', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'car' => $car
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


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->auto_id = $auto_id;
            $model->coordinator_id = Yii::$app->user->id;
            if($model->odo_end)
                $model->passed_km = $model->odo_end - $model->odo_start;

            $model->save(false);

            return $this->redirect(['index']);
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(!empty($model->odo_end) && $model->odo_end <= $model->odo_start){
                throw new Exception('test');
            }
            $model->passed_km = $model->odo_end - $model->odo_start;

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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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