<?php

namespace app\modules\warehouse\models\products;

use app\modules\warehouse\models\measurement\Measurement;
use app\modules\warehouse\models\products\query\ReceiptProductsQuery;
use phpDocumentor\Reflection\Types\Array_;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "receipt_products".
 *
 * @property int $id
 * @property string $date
 * @property string $from
 * @property string $to
 * @property string|null $documents
 * @property string|null $documents_comment
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ReceiptProducts extends \yii\db\ActiveRecord
{
    public $products;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'from', 'to'], 'required'],
            [['documents_comment'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at','products'], 'safe'],
            [['date', 'from', 'to', 'documents'], 'string', 'max' => 255],
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
            'from' => 'От кого',
            'to' => 'Кому',
            'documents' => 'Документ поступления',
            'documents_comment' => 'Комментарии к документу',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }


    /**
     * @return array
     */
    public function getAllMeasurement(): array
    {
        return ArrayHelper::map(Measurement::find()->where(['status'=>1])->asArray()->all(),'id','title');
    }

    /**
     * {@inheritdoc}
     * @return ReceiptProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReceiptProductsQuery(get_called_class());
    }
}
