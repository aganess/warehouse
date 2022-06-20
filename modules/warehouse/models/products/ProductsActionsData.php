<?php

namespace app\modules\warehouse\models\products;

use Yii;

/**
 * This is the model class for table "products_actions_data".
 *
 * @property int $id
 * @property int $actions_id
 * @property string $actions_type
 * @property string $data
 * @property int|null $status
 * @property string|null $created_at
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
            [['actions_id', 'actions_type', 'data'], 'required'],
            [['actions_id', 'status'], 'integer'],
            [['data'], 'string'],
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
            'data' => 'Data',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\products\query\ProductsActionsDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\warehouse\models\products\query\ProductsActionsDataQuery(get_called_class());
    }
}
