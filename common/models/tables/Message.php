<?php

namespace common\models\tables;

use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string event
 * @property string $type
 * @property string $recipient
 * @property string $subject
 * @property string $text
 * @property string $status
 * @property string $error
 * @property string $created_at
 * @property string $updated_at
 */
class Message extends \yii\db\ActiveRecord
{
    const MESSAGE_TYPE_EMAIL = 'email';
    const MESSAGE_TYPE_TELEGRAM = 'telegram';

    const MESSAGE_STATUS_READY = 'ready';
    const MESSAGE_STATUS_SUCCESS = 'success';
    const MESSAGE_STATUS_ERROR = 'error';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    public function beforeSave($insert)
    {
        if (empty($this->status)){
            $this->status = self::MESSAGE_STATUS_READY;
        }
        return parent::beforeSave($insert);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
//                'createdAtAttribute' => 'create_time',
//                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'error'], 'string'],
            [['type', 'status'], 'string', 'max' => 60],
            [['recipient'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'recipient' => 'Recipient',
            'text' => 'Text',
            'status' => 'Status',
            'error' => 'Error',
        ];
    }
}
