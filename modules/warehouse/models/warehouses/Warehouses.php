<?php

namespace app\modules\warehouse\models\warehouses;

use app\modules\warehouse\models\BaseSluggerTrait;
use app\modules\warehouse\models\warehouses\query\WarehousesQuery;
use Yii;

/**
 * This is the model class for table "warehouses".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Warehouses extends \yii\db\ActiveRecord
{
    use BaseSluggerTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'min' => 3, 'max' => 64],
            [['status'], 'integer'],
            [['created_at', 'updated_at', 'slug'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД склада',
            'title' => 'Название склада',
            'description' => 'Описание',
            'status' => 'Статус',
            'slug' => 'Слуг',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     * @return WarehousesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WarehousesQuery(get_called_class());
    }
}
