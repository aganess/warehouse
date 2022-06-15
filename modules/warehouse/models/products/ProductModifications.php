<?php

namespace app\modules\warehouse\models\products;

use Yii;

/**
 * This is the model class for table "product_modifications".
 *
 * @property int $id
 * @property string $title
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ProductModifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_modifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\products\query\ProductModificationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\warehouse\models\products\query\ProductModificationsQuery(get_called_class());
    }
}
