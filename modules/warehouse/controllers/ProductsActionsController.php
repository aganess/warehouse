<?php

namespace app\modules\warehouse\controllers;

use app\config\components\Common;
use app\modules\warehouse\models\products\ProductsActions;
use app\modules\warehouse\models\products\search\ProductsActionsSearch;
use app\modules\warehouse\models\services\ActionsService;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use Yii;

/**
 * ProductsActionsController implements the CRUD actions for ProductsActions model.
 */
class ProductsActionsController extends Controller
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
     * @return string
     */
    public function actionIndex()
    {
        $type = Yii::$app->request->get('type');

        if (!empty($type) && $type == 5) {

            $searchModel = new ProductsActionsSearch();
            $dataProvider = $searchModel->search($this->request->queryParams, 5, 'users', true);

            return $this->render('index-app', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        $searchModel = new ProductsActionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductsActions model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new ProductsActions();
        $defaultType = 1;


        if (!empty($this->request->get('type'))) {
            $defaultType = $this->request->get('type');
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $postData = $this->request->post('ProductsActions');

                $actionService = new ActionsService($postData, false, false, $defaultType);

                switch ($defaultType) {
                    case ProductsActions::INVENTORY_WAREHOUSE:
                        $actionService->createTypeOne();
                        break;
                    case ProductsActions::INVENTORY_EMPLOYEE:
                        $actionService->createTypeTwo();
                        break;
                    case ProductsActions::RECEIPT_GOODS_WAREHOUSE:
                        $actionService->createTypeThree();
                        break;
                    case ProductsActions::TRANSFER_OBJECT_EMPLOYEE:
                        $actionService->createFour();
                        break;
                    case ProductsActions::TRANSFER_APP:
                        $actionService->createFive();
                        break;
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'defaultType' => $defaultType
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $defaultType = $model->product->actions_type;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $postData = $this->request->post('ProductsActions');

                $actionService = new ActionsService($postData, true, $model->id, $defaultType);

                switch ($defaultType) {
                    case ProductsActions::INVENTORY_WAREHOUSE:
                        $actionService->createTypeOne();
                        break;
                    case ProductsActions::INVENTORY_EMPLOYEE:
                        $actionService->createTypeTwo();
                        break;
                    case ProductsActions::RECEIPT_GOODS_WAREHOUSE:
                        $actionService->createTypeThree();
                        break;
                    case ProductsActions::TRANSFER_OBJECT_EMPLOYEE:
                        $actionService->createFour();
                        break;
                    case ProductsActions::TRANSFER_APP:
                        $actionService = new ActionsService($postData, false, $model->id, $defaultType);
                        $actionService->createFiveForUpdate();
                        break;
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
            'defaultType' => $defaultType,
        ]);
    }

    /**
     * Deletes an existing ProductsActions model.
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
     * Finds the ProductsActions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ProductsActions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductsActions::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
