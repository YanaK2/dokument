<?php

namespace app\models;
use app\models\User;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "pattern".
 *
 * @property int $ID_pattern
 * @property int $ID_user
 * @property string $Category
 * @property string $name
 *
 * @property User $user
 */
class Pattern extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['ID_user', 'name'], 'required'],
            [['ID_user'], 'integer'],
            [['Category'], 'string'],
            [['name'],'file'],
            [['ID_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ID_user' => 'ID_user']],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_pattern' => 'Id Pattern',
            'ID_user' => 'ID_user',
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
