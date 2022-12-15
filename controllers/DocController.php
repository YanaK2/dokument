<?php
namespace app\controllers;
use app\models\User;
use Yii;
use app\controllers\FunctionController;
use app\models\Doc;
use app\models\Pattern;
use yii\filters\auth\HttpBearerAuth;
use yii\web\UploadedFile;

class DocController extends FunctionController
{
    public $modelClass = 'app\models\Doc';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['delete','delcat', 'newdoc','getdoc']
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $request=Yii::$app->request->post();
        $doc=new Doc();
        $user=Yii::$app->user->identity;
        $doc->ID_user=$user->ID_user;
        $doc->load($request,'Doc');
        if(!$doc->validate()) return $this->validation($doc);
        $doc->name = UploadedFile::getInstanceByName('name');
        $hash=hash('sha256',$doc->name->baseName).'.'.$doc->name->extension;
        $doc->name->saveAs(\Yii::$app->basePath. '/docs/'.$hash);
        $doc->name=$hash;
        $doc->save(false);
        return $this->send(201,['content'=>['code'=>201,'message'=>'Документ добавлен']]);

    }

    public function actionGetdoc($ID_doc)
    {
        $doc=Doc::findOne($ID_doc);
        $user=Yii::$app->user->identity;
        if ($doc==null){return $this->send(404,['message'=>'Документ не найден']);}
        return $this->send(200, ['content'=>['doc'=>$doc]]);//['user'=>$user]
    }

    public function actionDelcat($Category)
    {
        $docs = Doc::find()->where(['Category'=>$Category])->all();
        if (!$docs) return $this->send(404,['messege'=>'Категория не найдена']);
       // if (!$doc->validate()) return $this->validation($doc); //Валидация модели
        foreach ($docs as $doc)
        {
            $doc->delete();
        }
        return $this->send(201, ['content'=>['code'=>200, 'message'=>'Категория удалена']]);
    }

    public function actionDelete($ID_doc)
    {
        $doc = Doc::findOne($ID_doc);
        $user=Yii::$app->user->identity;
        if (!$doc) return $this->send(404,['messege'=>'Документ не найден']);
        $doc->delete();//Сохранение модели в БД
        return $this->send(201, ['content'=>['code'=>200, 'message'=>'Документ удален']]);
    }


}