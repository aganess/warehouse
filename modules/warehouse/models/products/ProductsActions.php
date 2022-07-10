<?php

namespace app\modules\warehouse\models\products;

use app\config\components\Common;
use app\models\User;
use app\modules\warehouse\models\measurement\Measurement;
use app\modules\warehouse\models\Objects;
use app\modules\warehouse\models\products\query\ProductsActionsQuery;
use app\modules\warehouse\models\Providers;
use app\modules\warehouse\models\Users;
use app\modules\warehouse\models\warehouses\Warehouses;
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
 * @property string|null $phone
 * @property string $from
 * @property string $action_type
 * @property string $parent_task
 * @property string $how_send
 * @property string $address
 * @property string $to
 * @property string $entity_from
 * @property string $entity_to
 * @property string|null $documents
 * @property string|null $documents_comment
 * @property int|null $status
 * @property string|null $created_at
 * @property-read string[] $allTypes
 * @property-read string[] $allObjects
 * @property-read array $allMeasurement
 * @property-read ProductsActionsData $product
 * @property-read array $allUsers
 * @property-read array $allProviders
 * @property-read array $allWarehouses
 * @property-read array $allUsersOrObjects
 * @property-read array $allProvidersOrUsers
 * @property-read ActiveQuery $productsData
 * @property-read string[] $allSendTypes
 * @property-read array $allUsersOrWarehouses
 * @property-read ActiveQuery $parentProductAction
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
    const TRANSFER_APP = 5;

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
            [['status'], 'integer'],
            [['documents_comment'], 'string'],
            [['created_at', 'updated_at', 'type', 'from', 'how_send', 'address',
                'to', 'entity_from', 'entity_to', 'products', 'action_type', 'parent_task'], 'safe'],
            [['date', 'phone', 'from', 'to', 'documents'], 'string', 'max' => 255],
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
            'phone' => 'Телефон',
            'to' => 'Куда',
            'from' => 'Кто',
            'parent_task' => 'Кто',
            'entity_from' => 'Сущность отправки',
            'entity_to' => 'Сущность получение',
            'object_id' => 'Объек',
            'documents' => 'Документ',
            'file' => 'Документ',
            'documents_comment' => 'Комментарий к документу',
            'type' => 'Выберите тип действия',
            'address' => 'Адрес',
            'how_send' => 'Как отправить',
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
            self::TRANSFER_APP => 'Заявка',
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
     * @param $product_id
     * @return string
     */
    public function getOneProductName($product_id)
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
     * @return array
     */
    public function getAllUsers(): array
    {
        return ArrayHelper::map(Users::find()->where(['status' => 1])->all(), 'id', 'username');
    }

    /**
     * @return array
     */
    public function getAllObjects(): array
    {
        return ArrayHelper::map(Objects::find()->where(['status' => 1])->all(), 'id', 'title');
    }

    /**
     * @return array
     */
    public function getAllProviders(): array
    {
        return ArrayHelper::map(Providers::find()->where(['status' => 1])->all(), 'id', 'title');
    }

    /**
     * @return array
     */
    public function getAllWarehouses(): array
    {
        return ArrayHelper::map(Warehouses::find()->where(['status' => 1])->all(), 'id', 'title');
    }

    /**
     * @return array
     */
    public function getAllUsersOrWarehouses(): array
    {
        $users = Users::find()->where(['status' => 1])->all();
        $warehouses = Warehouses::find()->where(['status' => 1])->all();

        return [
            'Пользователи' => ArrayHelper::map($users, 'username', 'username', true),
            'Склад' => ArrayHelper::map($warehouses, 'id', 'title', true),
        ];
    }

    /**
     * @return array
     */
    public function getAllProvidersOrUsers(): array
    {
        $users = Users::find()->where(['status' => 1])->all();
        $providers = Providers::find()->where(['status' => 1])->all();

        return [
            'Пользователи' => ArrayHelper::map($users, 'username', 'username', true),
            'Контрагенты' => ArrayHelper::map($providers, 'id', 'title', true),
        ];
    }

    /**
     * @return string[]
     */
    public function setAllSendTypes(): array
    {
        return [
            1 => 'ТК',
            2 => 'Самовызов',
            3 => 'Через сотрудника'

        ];
    }

    /**
     * @param $id
     * @return string
     */
    public static function getAllSendTypes($id)
    {
        return (new ProductsActions)->setAllSendTypes()[$id];
    }


    /**
     * @return array
     */
    public function getAllUsersOrObjects(): array
    {
        $users = Users::find()->where(['status' => 1])->all();
        $objects = Objects::find()->where(['status' => 1])->all();

        return [
            'Пользователи' => ArrayHelper::map($users, 'username', 'username', true),
            'Объекты ' => ArrayHelper::map($objects, 'id', 'title', true),
        ];
    }

    /**
     * @param $username
     * @return int|void
     */
    public function getUserIdByUsername($username)
    {
        if ($username) {
            return Users::findOne(['username' => $username])->id;
        }
    }

    public function getProductsData(): ActiveQuery
    {
        return $this->hasMany(ProductsActionsData::className(), ['actions_id' => 'id']);
    }

    /**
     * @param $id
     * @return int
     */
    public function getParent($id): int
    {
        return ProductsActions::findOne(['parent_task' => $id])->id;
    }

    /**
     * @return ActiveQuery
     */
    public function getParentProductAction(): ActiveQuery
    {
        return $this->hasOne(ProductsActions::className(), ['parent_task' => 'id']);
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
