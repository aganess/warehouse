<?php

namespace app\modules\warehouse\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\warehouse\models\Providers]].
 *
 * @see \app\modules\warehouse\models\Providers
 */
class ProvidersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\Providers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\Providers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
