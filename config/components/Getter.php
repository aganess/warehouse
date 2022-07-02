<?php

namespace app\config\components;

use app\modules\warehouse\models\measurement\Measurement;
use app\modules\warehouse\models\products\ProductModifications;
use app\modules\warehouse\models\products\Products;
use app\modules\warehouse\models\products\ProductsActionsData;
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
        foreach ($data as $key => $value) {
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

                    $product_name .= $this->getModificationTitleById($productExtDataKey) . ": " . '<b>'. $productExtDataValue . '</b>';
                    $global_key .= $productExtDataKey . $productExtDataValue;
                }

                $global_key = md5($global_key);
                $result[$global_key]['name'] =  $product_name  . ')';
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
        return ProductModifications::findOne(['id' => $id])->title ?? 'Не задано';
    }
}