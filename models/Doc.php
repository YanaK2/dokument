<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "doc".
 *
 * @property int $ID_docs
 * @property int $ID_user
 * @property string $Category
 * @property string $name
 *
 * @property User $user
 */
class Doc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_user', 'name'], 'required'],
            [['ID_user'], 'integer'],
            [['Category'], 'string'],
            [['name'], 'file'],
            [['ID_user'], 'unique'],
            [['ID_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ID_user' => 'ID_user']],
        ];
    }

    


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_docs' => 'Id Docs',
            'ID_user' => 'Id User',
            'Category' => 'Category',
            'name' => 'name',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['ID_user' => 'ID_user']);
    }
    public function beforeValidate(){
        $this->name=UploadedFile::getInstanceByName('name');
        return parent::beforeValidate();
    }
}
