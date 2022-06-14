<?php

namespace app\modules\warehouse\models\nomenclatureGroup\query;

/**
 * This is the ActiveQuery class for [[\app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups]].
 *
 * @see \app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups
 */
class NomenclatureGroupsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
