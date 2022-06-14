<?php

namespace app\modules\warehouse\models\nomenclatureGroup;

use app\config\components\Common;
use app\modules\warehouse\models\nomenclatureGroup\query\NomenclatureGroupsQuery;
use PhpOffice\PhpSpreadsheet\Writer\Ods\NamedExpressions;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "nomenclature_groups".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property int|null $status
 * @property string|null $created_at
 * @property-read ActiveQuery $parent
 * @property string|null $updated_at
 */
class NomenclatureGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomenclature_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'title'], 'required'],
            [['parent_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ИД группы',
            'parent_id' => 'Родительская категория',
            'title' => 'Название группы',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return array
     */
    public static function getAllCategories(): array
    {
        $baseCategory = [0 => 'Базовая категория'];

        $query = self::findAll(['status' => 1]);

        $array = [];
        foreach ($query as $value) {
            $array[$value->id] = $value->title;
        };

        return ArrayHelper::merge($baseCategory, $array);
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function getParent($key)
    {
        return self::getAllCategories()[$key];
    }

    /**
     * {@inheritdoc}
     * @return NomenclatureGroupsQuery the active query used by this AR class.
     */
    public static function find(): NomenclatureGroupsQuery
    {
        return new NomenclatureGroupsQuery(get_called_class());
    }
}
