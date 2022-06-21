<?php

namespace app\modules\warehouse\models\products;

use app\config\components\Common;
use app\modules\warehouse\models\measurement\Measurement;
use app\modules\warehouse\models\products\query\ProductsActionsQuery;
use Yii;
use yii\base\Exception;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

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
 * @property-read string[] $allTypes
 * @property-read string[] $allObjects
 * @property-read array $allMeasurement
 * @property-read ProductsActionsData $product
 * @property string|null $updated_at
 */
class ProductsActions extends \yii\db\ActiveRecord
{
    public $type;
    public $file;

    public $products;

    const INVENTORY_WAREHOUSE = 1;
    const INVENTORY_EMPLOYEE = 2;
    const RECEIPT_GOODS_WAREHOUSE = 3;
    const TRANSFER_OBJECT_EMPLOYEE = 4;

    protected $attachment_path = '/attachments/';
    protected $ampersand = '/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_actions';
    }

    /**
     * @return void
     */
    public function init()
    {
        parent::init();

        $action_id = Yii::$app->request->get('id');
        $this->products = Yii::$app->grid->getDynamicColumns($action_id);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['object_id', 'status'], 'integer'],
            [['documents_comment'], 'string'],
            [['created_at', 'updated_at', 'type', 'who', 'from', 'to', 'products'], 'safe'],
            [['date', 'who', 'phone', 'from', 'to', 'documents'], 'string', 'max' => 255],
            ['file', 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'date' => 'Дата',
            'who' => 'Кто',
            'phone' => 'Телефон',
            'from' => 'От кого',
            'to' => 'Кому',
            'object_id' => 'Объек',
            'documents' => 'Документ',
            'file' => 'Документ',
            'documents_comment' => 'Комментарий к документу',
            'type' => 'Выберите тип действия',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return string[]
     */
    public function getAllTypes(): array
    {
        return [
            self::INVENTORY_WAREHOUSE => 'Инвентаризация склада',
            self::INVENTORY_EMPLOYEE => 'Инвентаризация сотрудника',
            self::RECEIPT_GOODS_WAREHOUSE => 'Поступление товара на склад',
            self::TRANSFER_OBJECT_EMPLOYEE => 'Передача на объект / сотруднику',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        Yii::setAlias('@attachments', (dirname(__DIR__, 4)) . '/web/attachments');

        if ($file = UploadedFile::getInstance($this, 'file')) {
            FileHelper::createDirectory(Yii::getAlias('@attachments/actions'));
            $dir = Yii::getAlias('@attachments/actions/');
            $this->documents = Yii::$app->getSecurity()->generateRandomString(32) . '.' . $file->extension;

            $file->saveAs($dir . $this->documents);
        };

        return parent::beforeSave($insert);
    }

    /**
     * @return array
     */
    public function getAllMeasurement(): array
    {
        return ArrayHelper::map(Measurement::find()->where(['status' => 1])->asArray()->all(), 'id', 'title');
    }

    /**
     * @return string[]
     */
    public function getAllObjects(): array
    {
        return [
            1 => 'Склад',
            2 => 'Сотрудник',
        ];
    }

    /**
     * @param $product_id
     * @return string
     */
    public function getOneProductName($product_id): string
    {
        $product = Products::findOne(['id' => $product_id]);
        return $product->title;
    }

    /**
     * @return ActiveQuery
     */
    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(ProductsActionsData::className(), ['actions_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductsActionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsActionsQuery(get_called_class());
    }
}
