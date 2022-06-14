<?php

namespace app\modules\warehouse\models\measurement;

use app\modules\warehouse\models\measurement\query\MeasurementQuery;
use Yii;

/**
 * This is the model class for table "measurement".
 *
 * @property int $id
 * @property string $title
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Measurement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'measurement';
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
            'id' => 'ИД',
            'title' => 'Название',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MeasurementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeasurementQuery(get_called_class());
    }
}
