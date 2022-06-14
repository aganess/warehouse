<?php

namespace app\modules\warehouse\models\measurement\query;

/**
 * This is the ActiveQuery class for [[\app\modules\warehouse\models\measurement\Measurement]].
 *
 * @see \app\modules\warehouse\models\measurement\Measurement
 */
class MeasurementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\measurement\Measurement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\measurement\Measurement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
