<?php

namespace common\models\tables;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $role_id
 *
 * @property Role $role
 * @property string $password_repeat
 */

class User extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const SCENARIO_SIGNUP = 'signup';
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function beforeSave($insert) {
        if ($this->password) {
            $this->setPassword($this->password);
            $this->generateAuthKey();
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => 'common\models\tables\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 50],
            ['username', 'match', 'pattern' => '/^[A-z][\w]+$/'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'common\models\tables\User', 'message' => 'This email address has already been taken.'],
            [['role_id'], 'integer'],
            [['password', 'password_repeat', 'email'], 'string', 'min' => 5, 'max' => 100],
            [['password', 'password_repeat'], 'safe'],
            ['password_repeat', 'required', 'on' => self::SCENARIO_SIGNUP],
            ['password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => self::SCENARIO_SIGNUP],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
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
            'password' => 'Password',
            'password_repeat' => 'Repeat password',
            'role_id' => 'Role ID',
            'email' => 'Email'
        ];
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }


    public static function getUserWithRole($id)
    {
        return static::find()
            ->where(['id' => $id])
            ->with('role')
            ->one();
    }
}
