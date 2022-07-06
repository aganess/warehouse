<?php

namespace app\modules\warehouse\models;

use app\modules\warehouse\models\query\WarehouseEntitiesQuery;
use Yii;

/**
 * This is the model class for table "warehouse_entities".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class WarehouseEntities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_entities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return string|null
     */
    public static function getUserEvent(): ?string
    {
        return self::find()->where(['status' => 1])->andWhere(['id' => 1])->one()->title;
    }

    /**
     * @return string|null
     */
    public static function getObjectEvent(): ?string
    {
        return self::find()->where(['status' => 1])->andWhere(['id' => 2])->one()->title;
    }

    /**
     * @return string|null
     */
    public static function getProviderEvent(): ?string
    {
        return self::find()->where(['status' => 1])->andWhere(['id' => 3])->one()->title;
    }

    /**
     * @return string|null
     */
    public static function getWarehouseEvent(): ?string
    {
        return self::find()->where(['status' => 1])->andWhere(['id' => 4])->one()->title;
    }

    /**
     * @return string|null
     */
    public static function getApplicationEvent(): ?string
    {
        return self::find()->where(['status' => 1])->andWhere(['id' => 5])->one()->title;
    }
    /**
     * {@inheritdoc}
     * @return WarehouseEntitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WarehouseEntitiesQuery(get_called_class());
    }
}
