<?php

namespace app\modules\warehouse\models\products\query;

/**
 * This is the ActiveQuery class for [[\app\modules\warehouse\models\products\ProductsActionsData]].
 *
 * @see \app\modules\warehouse\models\products\ProductsActionsData
 */
class ProductsActionsDataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\products\ProductsActionsData[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\products\ProductsActionsData|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
