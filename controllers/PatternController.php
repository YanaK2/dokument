<?php
namespace app\controllers;
use app\controllers\FunctionController;
use app\models\Pattern;

use Yii;

use yii\filters\auth\HttpBearerAuth;
use yii\web\Request;
use app\models\Doc;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class PatternController extends FunctionController
{
    public $modelClass = 'app\models\Pattern';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['create']
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $request=Yii::$app->request->post();
        $pattern=new Pattern();
        $user=Yii::$app->user->identity;
        $pattern->ID_user=$user->ID_user;
        $pattern->load($request,'Pattern');
        if(!$pattern->validate()) return $this->validation($pattern);
        $pattern->name = UploadedFile::getInstanceByName('name');
        $hash=hash('sha256',$pattern->name->baseName).'.'.$pattern->name->extension;
        $pattern->name->saveAs(\Yii::$app->basePath. '/patterns/'.$hash);
        $pattern->name=$hash;
        $pattern->save(false);
        return $this->send(201,['content'=>['code'=>201,'message'=>'Шаблон добавлен']]);

    }

}