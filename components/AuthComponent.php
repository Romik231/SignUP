<?php


namespace app\components;


use app\models\Users;
use yii\base\Component;
use yii\web\User;

class AuthComponent extends Component
{
    public function signup(Users &$user): bool
    {

        $user->scenarioSignup();
        if (!$user->validate(['email', 'password'])) {
            return false;
        }

        $user->password_hash = $this->genPasswordHash($user->password);

        if (!$user->save()) {
            return false;
        }
        return true;
    }

//Функция авторизации
    public function signin(Users &$model)
    {
        $model->scenarioSignin();
        if (!$model->validate(['email', 'password'])) {
            return false;
        }

        $user=$this->getUserByEmail($model->email);

        if (!$this->validationPassword($model->password, $user->password_hash)){
            $model->addError('password', 'Неверный пароль');
            return false;
        }

        return \Yii::$app->user->login($user, 3600);
    }

//Проверка совпадения паролей
    private function validationPassword($password, $password_hash):bool {
        return \Yii::$app->security->validatePassword($password, $password_hash);
    }

//Получение пользователя из базы по email
    private function getUserByEmail($email): ?Users{
        return Users::find()->andWhere(['email'=>$email])->one();
    }


// Генерируем хэш пароля
    private function genPasswordHash($password): string
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }

}