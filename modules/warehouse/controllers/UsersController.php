<?php

namespace app\modules\warehouse\controllers;

use app\modules\warehouse\models\products\ProductsActions;
use app\modules\warehouse\models\WarehouseEntities;
use Yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\config\components\Common;
use yii\web\NotFoundHttpException;
use app\modules\warehouse\models\Users;
use app\modules\warehouse\models\search\UsersSearch;
use app\modules\warehouse\models\products\search\ProductsActionsSearch;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        $searchModel = new ProductsActionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, ProductsActions::TRANSFER_OBJECT_EMPLOYEE, WarehouseEntities::getUserEvent());

        $data = Yii::$app->getter->getExtDataByFilter($dataProvider->getModels());
        $dataApp = Yii::$app->getter->getExtDataByFilter($searchModel->searchBySendАpp($id));
        $send = Yii::$app->getter->getExtDataByFilter($searchModel->searchBySend($id));

        $inv = ProductsActions::find()
            ->where(['status' => 1])
            ->andWhere(['entity_from' => WarehouseEntities::getUserEvent()])
            ->andWhere(['from' => $id])
            ->andWhere(['to' => null])
            ->andWhere(['entity_to' => null])
            ->andWhere(['action_type' => 2])
            ->orderBy(['id' => SORT_DESC])->one();

        if ($inv) {

            $inv_data = Yii::$app->getter->getUserInvForeachResult($inv);

            return $this->render('view', [
                'data' => $inv_data,
                'model' => $this->findModel($id),
            ]);
        } else {
            foreach ($dataApp as $sdk => $sendData) {
                if ($data[$sdk]) {
                    $data[$sdk]['count'] += $sendData['count'];
                } else {
                    $data[$sdk] = $sendData;
                }
            }

            foreach ($send as $sdk => $sendData) {
                if ($data[$sdk]) {
                    $data[$sdk]['count'] -= $sendData['count'];
                } else {
                    $data[$sdk] = $sendData;
                }
            }

            return $this->render('view', [
                'model' => $this->findModel($id),
                'data' => $data
            ]);
        }

    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Users();

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
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
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
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
