<?php

namespace app\modules\warehouse\models;

use Yii;

/**
 * This is the model class for table "objects".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
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
            'slug' => 'Slug',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\query\ObjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\warehouse\models\query\ObjectsQuery(get_called_class());
    }
}
