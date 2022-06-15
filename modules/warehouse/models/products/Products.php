<?php

namespace app\modules\warehouse\models\products;

use app\modules\warehouse\models\BaseImageTrait;
use app\modules\warehouse\models\BaseSluggerTrait;
use app\modules\warehouse\models\measurement\Measurement;
use app\modules\warehouse\models\nomenclatureGroup\NomenclatureGroups;
use app\modules\warehouse\models\products\query\ProductsQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

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
 * @property-read array $measurements
 * @property-read array $groups
 * @property-read ActiveQuery $group
 * @property-read ActiveQuery $measurement
 * @property string|null $updated_at
 */
class Products extends \yii\db\ActiveRecord
{
    use BaseSluggerTrait, BaseImageTrait;
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
            [['group_id', 'measurement_id', 'title'], 'required'],
            [['group_id', 'measurement_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['quantity'], 'number'],
            [['created_at', 'updated_at',  'slug'], 'safe'],
            [['title', 'manufacturer', 'article', 'inventory_number', 'expiration_date', 'img'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 64],
            ['file','file']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД продукта',
            'group_id' => 'Название группы',
            'measurement_id' => 'Название единицы измерения',
            'title' => 'Название продукта',
            'slug' => 'Слуг',
            'description' => 'Описание',
            'manufacturer' => 'Производитель',
            'article' => 'Артикул',
            'quantity' => 'Количество',
            'inventory_number' => 'Инвентарный номер',
            'expiration_date' => 'Срок годности',
            'img' => 'Картинка',
            'file' => 'Картинка',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return array
     */
    public function getMeasurements(): array
    {
        return ArrayHelper::map(Measurement::find()->where(['status'=>1])->asArray()->all(),'id','title');
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        return ArrayHelper::map(NomenclatureGroups::find()->where(['status'=>1])->asArray()->all(),'id','title');
    }

    /**
     * @return ActiveQuery
     */
    public function getGroup(): ActiveQuery
    {
        return $this->hasOne(NomenclatureGroups::className(),['id'=>'group_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMeasurement(): ActiveQuery
    {
        return $this->hasOne(Measurement::className(),['id'=>'measurement_id']);
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
