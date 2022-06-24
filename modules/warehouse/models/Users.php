<?php

namespace app\modules\warehouse\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $last_name
 * @property string $first_name
 * @property string $email
 * @property string $password
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'last_name', 'first_name', 'email', 'password'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'last_name', 'first_name', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\warehouse\models\query\UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\warehouse\models\query\UsersQuery(get_called_class());
    }
}
