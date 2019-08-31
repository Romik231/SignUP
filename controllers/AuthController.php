<?php


namespace app\controllers;


use app\models\Users;
use yii\web\Controller;

class AuthController extends Controller
{

    public function actionSignUp()
    {
        $model = new Users();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->auth->signup($model)) {

                $this->redirect('/auth/sign-in');
            }
        }

        return $this->render('signup', ['model' => $model]);
    }


    public function actionSignIn()
    {
        $model = new Users();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->auth->signin($model)) {
                $this->redirect('/');
            }
        }

        return $this->render('signin', ['model' => $model]);
    }

    public function actionActivation()
    {
        $code=\Yii::$app->request->get('code');
        $findUser=Users::find()->andWhere(['email_confirm_token'=>$code])->one();

//        $findUser =\Yii::$app->auth->checkEmailToken($code);
        print_r($findUser->status);
        $findUser->status = 1;
        $findUser->save();
        print_r($findUser->status);
        //$findUser->status = 1;

//        if(!$findUser){
//             echo 'ошибка';
//        }else{
//            $findUser->status=1;
//            $findUser->save();
//        }


    }

}