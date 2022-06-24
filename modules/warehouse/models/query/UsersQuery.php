<?php

namespace app\modules\warehouse\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\warehouse\models\Users]].
 *
 * @see \app\modules\warehouse\models\Users
 */
class UsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\Users[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\Users|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
