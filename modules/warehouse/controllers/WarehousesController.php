<?php

namespace app\modules\warehouse\controllers;

use Yii;
use app\config\components\Common;
use app\modules\warehouse\models\products\ProductsActions;
use app\modules\warehouse\models\products\search\ProductsActionsSearch;
use app\modules\warehouse\models\WarehouseEntities;
use app\modules\warehouse\models\warehouses\Warehouses;
use app\modules\warehouse\models\warehouses\search\WarehousesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WarehousesController implements the CRUD actions for Warehouses model.
 */
class WarehousesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Warehouses models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new WarehousesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Warehouses model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new ProductsActionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, ProductsActions::RECEIPT_GOODS_WAREHOUSE, WarehouseEntities::getWarehouseEvent());

        $data = Yii::$app->getter->getExtDataByFilter($dataProvider->getModels());
        $send = Yii::$app->getter->getExtDataByFilter($searchModel->searchBySendWarehouse($id));

        foreach ($send as $sdk => $sendData) {
            if ($data[$sdk]) {
                $data[$sdk]['count'] -= $sendData['count'];
            } else {
                foreach ($sendData as $key => $value) {
                    if ($key === 'count') {
                        $data[$sdk][$key] -= $value;
                    }else {
                        $data[$sdk][$key] = $value;
                    }
                }
            }
        }
        return $this->render('view', [
            'data' => $data,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Warehouses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Warehouses();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Warehouses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Warehouses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Warehouses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Warehouses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Warehouses::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
