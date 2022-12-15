<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $ID_user
 * @property string $Firstname
 * @property string $Lastname
 * @property string $Post
 * @property string $Password
 * @property string $Root
 * @property string $token
 *
 * @property Doc $doc
 * @property Pattern $pattern
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function findIdentity($ID_user)
    {
        return static::findOne($ID_user);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public function getId()
    {
        return $this->ID_user;
    }

    public function getAuthKey()
    {
        return;
    }

    public function validateAuthKey($authKey)
    {
        return;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
    public function rules()
    {
        return [
            [['Firstname', 'Lastname', 'Post', 'Password', 'Root', 'token'], 'required'],
            [['Post', 'Root'], 'string'],
            [['Firstname', 'Lastname', 'Password'], 'string', 'max' => 200],
            [['token'], 'string', 'max' => 100],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        // удаляем небезопасные поля
        unset($fields['Password'], $fields['token']);
        return $fields;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_user' => 'ID_user',
            'Firstname' => 'Firstname',
            'Lastname' => 'Lastname',
            'Post' => 'Post',
            'Password' => 'Password',
            'Root' => 'Root',
            'token' => 'token',
        ];
    }

    /**
     * Gets query for [[Doc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(Doc::className(), ['ID_user' => 'ID_user']);
    }


    public function getPattern()
    {
        return $this->hasOne(Pattern::className(), ['ID_user' => 'ID_user']);
    }
}
