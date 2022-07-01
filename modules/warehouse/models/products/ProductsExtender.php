<?php

namespace app\modules\warehouse\models\products;

use app\modules\warehouse\models\products\query\ProductsExtenderQuery;
use Yii;

/**
 * This is the model class for table "products_extender".
 *
 * @property int $id
 * @property int|null $product_action_data_id
 * @property string|null $key
 * @property string|null $value
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ProductsExtender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_extender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_action_data_id', 'status'], 'integer'],
            [['created_at', 'updated_at', 'key', 'value'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'key' => 'Key',
            'value' => 'Value',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductsExtenderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsExtenderQuery(get_called_class());
    }
}
