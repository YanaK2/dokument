<?php
namespace app\controllers;
use app\controllers\FunctionController;
use app\models\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

use app\models\LoginForm;


class UserController extends FunctionController
{
    public $modelClass = 'app\models\User';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['account','editaccount']
        ];
        return $behaviors;
    }


    public function actionCreate()
    {
        $request=Yii::$app->request->post(); //получение данных из post запроса
        $user=new User($request); // Создание модели на основе присланных данных
        if (!$user->validate()) return $this->validation($user); //Валидация модели
        $user->Password=Yii::$app->getSecurity()->generatePasswordHash($user->Password); //хэширование пароля
        $user->save();//Сохранение модели в БД
        return $this->send(201, ['content'=>['code'=>201, 'message'=>'Вы зарегистрировались']]);//Отправка сообщения пользователю
    }
  public function actionLogin()
    {
        $request=Yii::$app->request->post();//Здесь не объект, а ассоциативный массив
        $loginForm=new LoginForm($request);
        if (!$loginForm->validate()) return $this->validation($loginForm);
        $user=User::find()->where(['ID_user'=>$request['ID_user']])->one();
        if (isset($user) && Yii::$app->getSecurity()->validatePassword($request['Password'], $user->Password)){
            $user->token=Yii::$app->getSecurity()->generateRandomString();
            $user->save(false);
            return $this->send(200, ['content'=>['token'=>$user->token]]);//['user'=>$user]
        }
        return $this->send(401, ['content'=>['code'=>401, 'message'=>'Неверный ID или пароль']]);
    }

    public function actionAccount()
    {
      $user=Yii::$app->user->identity;
      return $this->send(200, $user);

    }

    public function actionEditaccount($ID_user)
    {
        $request=Yii::$app->request->getBodyParams();
        $user=Yii::$app->user->identity;
        $user=user::findOne($ID_user);
        foreach ($request as $key => $value){
            $user->$key=$value;
        }
        if (!$user->validate()) return $this->validation($user); //Валидация модели
        $user->save();//Сохранение модели в БД
        return $this->send(201, ['content'=>['code'=>200, 'message'=>'Данные пользователя изменены']]);//Отправка сообщения пользователю
    }
}