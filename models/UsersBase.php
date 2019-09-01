<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $email_confirm_token
 * @property string $password_hash
 * @property string $createdAt
 * @property int $status
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
            [['createdAt'], 'safe'],
            [['status'], 'integer'],
            [['email', 'password_hash'], 'string', 'max' => 150],
            [['email_confirm_token'], 'string', 'max' => 255],
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
            'password_hash' => Yii::t('app', 'Password Hash'),
            'createdAt' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
