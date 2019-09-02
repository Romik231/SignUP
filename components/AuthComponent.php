<?php


namespace app\components;


use app\models\Users;
use http\Url;
use yii\base\Component;
use yii\web\User;

class AuthComponent extends Component
{

//Функция регистрации
    public function signup(Users &$user): bool
    {

        $user->scenarioSignup();
        if (!$user->validate(['email', 'password'])) {
            return false;
        }

        $user->password_hash = $this->genPasswordHash($user->password);
        $user->email_confirm_token = $this->genUniqTokenPropertyEmail();
        $this->sendActivationUserMail($user->email, $user->email_confirm_token);

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

        $user = $this->getUserByEmail($model->email);


        if (!$this->validationPassword($model->password, $user->password_hash) or $user->status == 0) {
            $model->addError('password', 'Неверный пароль или учетная запись не активирована');
            return false;
        }if($user->status == 0){

    }

        return \Yii::$app->user->login($user, 3600);
    }

//Проверка совпадения паролей
    private function validationPassword($password, $password_hash): bool
    {
        return \Yii::$app->security->validatePassword($password, $password_hash);
    }

//Получение пользователя из базы по email
    private function getUserByEmail($email)
    {
        return Users::find()->andWhere(['email' => $email])->one();
    }


// Генерируем хэш пароля
    private function genPasswordHash($password): string
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }

// Генерация уникального токена для подтверждения почты
    private function genUniqTokenPropertyEmail()
    {
        return \Yii::$app->security->generateRandomString(16);
    }

//Подтверждение регистрации пользователя
    public function confirmEmailToken($token): bool
    {
        $findUserForActivation = Users::find()->andWhere(['email_confirm_token' => $token])->one();
        if (!$findUserForActivation) {
            return false;
        } else {
            $findUserForActivation->status = 1;
            $findUserForActivation->save(false);
        }
        return true;

    }

//Отправка письма с кодом подтверждения
    public static function sendActivationUserMail($email, $confirm_token)
    {
        \Yii::$app->mailer->compose('mail', compact('email', 'confirm_token'))
            ->setFrom('r.spe.m.ctre.k@gmail.com')
            ->setTo($email)
            ->setSubject('Активация аккаунта')
            ->send();
    }

}