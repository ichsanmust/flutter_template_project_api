<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mobile_session".
 *
 * @property int $id
 * @property int $id_user
 * @property string $auth_key
 * @property string $device_mobile_id
 * @property string $application_id
 * @property string $valid_date_time
 * @property string $status
 */
class MobileSession extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mobile_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'auth_key', 'device_mobile_id', 'application_id', 'valid_date_time'], 'required'],
            [['id_user', 'status'], 'integer'],
            [['valid_date_time'], 'safe'],
            [['auth_key'], 'string', 'max' => 32],
            [['device_mobile_id', 'application_id'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'auth_key' => 'Auth Key',
            'device_mobile_id' => 'Device Mobile ID',
            'application_id' => 'Application ID',
            'valid_date_time' => 'Valid Date Time',
            'status' => 'Status',
        ];
    }
}
