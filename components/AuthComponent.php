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


        if (!$this->validationPassword($model->password, $user->password_hash)) {
            $model->addError('password', 'Неверный пароль');
            return false;
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

    public static function sendActivationUserMail($email, $confirm_token)
    {

        $url='yii/activation/'.$confirm_token;

        $msg="<p><strong>Для этого перейдите по ссылке </strong><a href='". $url."'>$url</a></p>\r\n";

        \Yii::$app->mailer->compose()
            ->setFrom('r.spe.m.ctre.k@gmail.com')
            ->setTo($email)
            ->setSubject('Активация')
            ->setHtmlBody($msg)
            ->send();
    }

}