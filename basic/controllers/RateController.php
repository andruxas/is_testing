<?php

namespace app\controllers;

use Yii;
use app\models\Rate;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * RateController implements the CRUD actions for Rate model.
 */
class RateController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Rate models.
     * @return mixed
     */
	 /*
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Rate::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }*/
	
public function actionIndex()
{
    $searchModel = new Rate;
	$dataProvider = new ActiveDataProvider(['query' => Rate::find()]);
 
    if (Yii::$app->request->post('hasEditable')) {

        $itemID= Yii::$app->request->post('editableKey');
        $model = Rate::findOne($itemID);
 
        $out = Json::encode(['output'=>'', 'message'=>'']);
 
        $post = [];
        $posted = current($_POST['Rate']);
        $post['Rate'] = $posted;
 
        if ($model->load($post)) {
            $model->save();
 
            $output = '';
            if (isset($posted['Rate'])) {
               $output =  Yii::$app->formatter->asDecimal($model->speed, 1);
            } 
 
            $out = Json::encode(['output'=>$output, 'message'=>'']);
        } 

        echo $out;
        return;
    }
 
    // non-ajax - render the grid by default
    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}	
	

    /**
     * Displays a single Rate model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
    public function actionField() {
        if (isset($_POST['field'])) {
            $field = $_POST['field'];
            if (isset($_POST['id'])) {
                $model = CActiveRecord::model($this->modelName)->resetScope()->findByPk($_POST['id']);
                if ($model != null) {
                    $model->$field = $_POST['value'];
                    $model->save();
                    Yii::app()->end();
                }
            }
        }
    }	
	

    /**
     * Deletes an existing Rate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
