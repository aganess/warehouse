<?php

namespace app\modules\warehouse\models\products;

use app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups;
use app\modules\warehouse\models\products\query\ProductsModificationsGroupsQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products_modifications_groups".
 *
 * @property int $id
 * @property int $modification_id
 * @property int $group_id
 * @property int|null $status
 * @property string|null $created_at
 * @property-read ActiveQuery $group
 * @property-read ActiveQuery $modification
 * @property-read array $allModifications
 * @property-read array $allGroups
 * @property string|null $updated_at
 */
class ProductsModificationsGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_modifications_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['modification_id', 'group_id'], 'required'],
            [['modification_id', 'group_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'modification_id' => 'Модификация',
            'group_id' => 'Имя группы',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return array
     */
    public function getAllGroups(): array
    {
        return ArrayHelper::map(NomenclatureGroups::find()->where(['status' => 1])->andWhere((['parent_id' => 0]))->asArray()->all(), 'id', 'title');
    }

    /**
     * @return array
     */
    public function getAllModifications(): array
    {
        return ArrayHelper::map(ProductModifications::find()->where(['status' => 1])->asArray()->all(), 'id', 'title');
    }

    /**
     * @return ActiveQuery
     */
    public function getGroup(): ActiveQuery
    {
        return $this->hasOne(NomenclatureGroups::className(), ['id' => 'group_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getModification(): ActiveQuery
    {
        return $this->hasOne(ProductModifications::className(), ['id' => 'modification_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductsModificationsGroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsModificationsGroupsQuery(get_called_class());
    }
}
