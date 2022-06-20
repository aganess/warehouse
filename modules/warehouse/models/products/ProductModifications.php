<?php

namespace app\modules\warehouse\models\products;

use app\modules\warehouse\models\BaseSluggerTrait;
use app\modules\warehouse\models\products\query\ProductModificationsQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_modifications".
 *
 * @property int $id
 * @property string $title
 * @property string $value
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ProductModifications extends ActiveRecord
{
    use BaseSluggerTrait;
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
            [['title' ,'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД модиификации',
            'title' => 'Название',
            'slug' => 'Слуг',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductModificationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductModificationsQuery(get_called_class());
    }
}
