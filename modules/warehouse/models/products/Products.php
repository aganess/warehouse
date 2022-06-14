<?php

namespace app\modules\warehouse\models\products;

use app\modules\warehouse\models\products\query\ProductsQuery;
use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $group_id
 * @property int $measurement_id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string|null $manufacturer
 * @property string|null $article
 * @property float|null $quantity
 * @property string|null $inventory_number
 * @property string|null $expiration_date
 * @property string|null $img
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'measurement_id', 'title', 'slug'], 'required'],
            [['group_id', 'measurement_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['quantity'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'manufacturer', 'article', 'inventory_number', 'expiration_date', 'img'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'measurement_id' => 'Measurement ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'manufacturer' => 'Manufacturer',
            'article' => 'Article',
            'quantity' => 'Quantity',
            'inventory_number' => 'Inventory Number',
            'expiration_date' => 'Expiration Date',
            'img' => 'Img',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }
}
