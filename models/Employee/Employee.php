<?php

namespace app\models\Employee;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $birthday
 * @property string $photo
 * @property int $created_at
 * @property int $updated_at
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }
	
	public static function primaryKey()
    {
        return ["id"];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['birthday'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['photo'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'birthday' => 'Birthday',
            'photo' => 'Photo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
