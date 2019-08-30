<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $email_confirm_token
 * @property int $status
 * @property string $password_hash
 * @property string $createdAt
 */
class UsersBase extends \yii\db\ActiveRecord
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
            [['email', 'password_hash'], 'required'],
            [['status'], 'integer'],
            [['createdAt'], 'safe'],
            [['email', 'password_hash'], 'string', 'max' => 150],
            [['email_confirm_token'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['email_confirm_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'email_confirm_token' => Yii::t('app', 'Email Confirm Token'),
            'status' => Yii::t('app', 'Status'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'createdAt' => Yii::t('app', 'Created At'),
        ];
    }
}
