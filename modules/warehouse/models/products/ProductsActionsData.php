<?php

namespace app\modules\warehouse\models\products;

use app\modules\warehouse\models\products\query\ProductsActionsDataQuery;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "products_actions_data".
 *
 * @property int $id
 * @property int $actions_id
 * @property int $product_id
 * @property int $quantity
 * @property int $measurement
 * @property string $actions_type
 * @property int|null $status
 * @property string|null $created_at
 * @property-read mixed $extData
 * @property string|null $updated_at
 */
class ProductsActionsData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_actions_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['actions_id', 'actions_type', 'product_id'], 'required'],
            [['actions_id', 'status'], 'integer'],
            [['product_id', 'quantity', 'measurement'], 'safe'],
            [['created_at', 'updated_at'], 'safe'],
            [['actions_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'actions_id' => 'Actions ID',
            'actions_type' => 'Actions Type',
            'quantity' => 'Quantity',
            'measurement' => 'Measurement',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getExtData(): ActiveQuery
    {
        return $this->hasMany(ProductsExtender::className(),['product_action_data_id'=>'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductsActionsDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsActionsDataQuery(get_called_class());
    }
}
