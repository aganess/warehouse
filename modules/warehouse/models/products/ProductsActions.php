<?php

namespace app\modules\warehouse\models\products;

use Yii;

/**
 * This is the model class for table "products_actions".
 *
 * @property int $id
 * @property string $date
 * @property string $who
 * @property string|null $phone
 * @property string $from
 * @property string $to
 * @property int|null $object_id
 * @property string|null $documents
 * @property string|null $documents_comment
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ProductsActions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_actions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'who', 'from', 'to'], 'required'],
            [['object_id', 'status'], 'integer'],
            [['documents_comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['date', 'who', 'phone', 'from', 'to', 'documents'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'who' => 'Who',
            'phone' => 'Phone',
            'from' => 'From',
            'to' => 'To',
            'object_id' => 'Object ID',
            'documents' => 'Documents',
            'documents_comment' => 'Documents Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\products\query\ProductsActionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\warehouse\models\products\query\ProductsActionsQuery(get_called_class());
    }
}
