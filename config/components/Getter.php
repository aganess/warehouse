<?php

namespace app\config\components;

use app\modules\warehouse\models\measurement\Measurement;
use app\modules\warehouse\models\products\ProductModifications;
use app\modules\warehouse\models\products\Products;
use app\modules\warehouse\models\products\ProductsActions;
use app\modules\warehouse\models\products\ProductsActionsData;
use app\modules\warehouse\models\Users;
use app\modules\warehouse\models\WarehouseEntities;
use Mpdf\Tag\U;
use Yii;
use yii\base\Component;


class Getter extends Component
{
    /**
     * @param $data
     * @return array
     */
    public function getExtDataByFilter($data): array
    {
        $result = [];
        foreach ($data as  $value) {
            /** @var ProductsActionsData $productActionData */
            foreach ($value['productsData'] as $productActionData) {
                $global_key = '';
                $product_name = $this->getProductTitleById($productActionData->product_id) . ' (';
                $product_id = $productActionData->product_id;
                $quantity = $productActionData->quantity;
                $measurement = $productActionData->measurement;

                $global_key = $product_id . $measurement;

                foreach ($productActionData->extData as $productExtData) {
                    $productExtDataKey = $productExtData->key . ' ';
                    $productExtDataValue = $productExtData->value . ' ';

                    $product_name .= $this->getModificationTitleById($productExtDataKey) . ": " . '<b>' . $productExtDataValue . '</b>';
                    $global_key .= $productExtDataKey . $productExtDataValue;
                }

                $global_key = md5($global_key);
                $result[$global_key]['name'] = $product_name . ')';
                $result[$global_key]['count'] += $quantity;
                $result[$global_key]['measurement'] = $this->getMeasurementTitleById($measurement);
            }
        }

        return $result;

    }

    /**
     * @param $id
     * @return string
     */
    public function getMeasurementTitleById($id)
    {
        return Measurement::findOne(['id' => $id])->title;
    }


    /**
     * @param $product_id
     * @return int
     */
    public function getProductIdById($product_id)
    {
        return Products::findOne(['id' => $product_id])->id;
    }


    /**
     * @param $id
     * @return string|null
     */
    public function getUserById($id): ?string
    {
        return Users::findOne(['id' => $id])->username ?? null;
    }

    /**
     * @param $product_id
     * @return int
     */
    public function getProductTitleById($product_id)
    {
        return Products::findOne(['id' => $product_id])->title;
    }


    /**
     * @param $slug
     * @return int
     */
    public function getModificationIdBySlug($slug)
    {
        return ProductModifications::findOne(['slug' => $slug])->id;
    }


    /**
     * @param $id
     * @return string
     */
    public function getModificationTitleById($id)
    {
        return ProductModifications::findOne(['id' => $id])->title ?? '???? ????????????';
    }

    /**
     * @param $id
     * @return array|void
     */
    public function getModificationSlugById($id)
    {
        $result = ProductModifications::find()->where(['id' => $id])->asArray()->all();
        foreach ($result as $key => $value) {
            return $value['slug'];
        }
    }


    /**
     * @param $data
     * @return array
     */
    public function getUserInvForeachResult($data): array
    {
        $pr_action = ProductsActions::find()
            ->with('productsData.extData')
            ->where(['>', 'id', $data->id])
            ->andWhere(['action_type' => ProductsActions::TRANSFER_OBJECT_EMPLOYEE])
            ->andWhere(['entity_to' => WarehouseEntities::getUserEvent()])
            ->andWhere(['to' => $data->from])
            ->all();

        $pr_action_ = ProductsActions::find()
            ->with('productsData.extData')
            ->where(['>', 'id', $data->id])
            ->andWhere(['action_type' => ProductsActions::RECEIPT_GOODS_WAREHOUSE])
            ->andWhere(['entity_from' => WarehouseEntities::getUserEvent()])
            ->andWhere(['from' => $data->from])
            ->all();

        $pr_action[] = $data;

        $res_prd = Yii::$app->getter->getExtDataByFilter($pr_action);
        $res_prd_ = Yii::$app->getter->getExtDataByFilter($pr_action_);

        foreach ($res_prd_ as $sdk => $sendData) {
            if ($res_prd[$sdk]) {
                $res_prd[$sdk]['count'] -= $sendData['count'];
            } else {
                foreach ($sendData as $key => $value) {
                    if ($key === 'count') {
                        $res_prd[$sdk][$key] -= $value;
                    } else {
                        $res_prd[$sdk][$key] = $value;
                    }
                }
            }
        }
        return $res_prd;

    }

    /**
     * @param $data
     * @return array
     */
    public function getWarehouseInvForeachResult($data): array
    {
        $pr_action = ProductsActions::find()
            ->with('productsData.extData')
            ->where(['>', 'id', $data->id])
            ->andWhere(['action_type' => ProductsActions::RECEIPT_GOODS_WAREHOUSE])
            ->andWhere(['entity_to' => WarehouseEntities::getWarehouseEvent()])
            ->andWhere(['to' => $data->to])
            ->all();

        $pr_action_ = ProductsActions::find()
            ->with('productsData.extData')
            ->where(['>', 'id', $data->id])
            ->andWhere(['action_type' => ProductsActions::TRANSFER_OBJECT_EMPLOYEE])
            ->andWhere(['entity_from' => WarehouseEntities::getWarehouseEvent()])
            ->andWhere(['from' => $data->to])
            ->all();


        $pr_action[] = $data;

        $res_prd = Yii::$app->getter->getExtDataByFilter($pr_action);
        $res_prd_ = Yii::$app->getter->getExtDataByFilter($pr_action_);

        foreach ($res_prd_ as $sdk => $sendData) {
            if ($res_prd[$sdk]) {
                $res_prd[$sdk]['count'] -= $sendData['count'];
            } else {
                foreach ($sendData as $key => $value) {
                    if ($key === 'count') {
                        $res_prd[$sdk][$key] -= $value;
                    } else {
                        $res_prd[$sdk][$key] = $value;
                    }
                }
            }
        }
        return $res_prd;
    }
}