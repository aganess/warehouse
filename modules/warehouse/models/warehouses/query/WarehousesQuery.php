<?php

namespace app\modules\warehouse\models\warehouses\query;

/**
 * This is the ActiveQuery class for [[\app\modules\warehouse\models\warehouses\Warehouses]].
 *
 * @see \app\modules\warehouse\models\warehouses\Warehouses
 */
class WarehousesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\warehouses\Warehouses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\warehouses\Warehouses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
