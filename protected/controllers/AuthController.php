<?php

class AuthController extends Controller {

    public function actionIndex() {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->user->changeLastActivity();
        }
        $this->redirect('/');
        Yii::app()->end();
    }

    public function actionLogin() {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->changeLastActivity();
            $this->redirect('/');
            Yii::app()->end();
        }

        $model = new LoginForm();
        $user = new User();

        //TODO

        $this->render('login', ['model' => $model]);
        Yii::app()->end();
    }

    public function actionRegister() {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->changeLastActivity();
            $this->redirect('/');
            Yii::app()->end();
        }

        $model = new RegisterForm();
        $user = new User();

        // TODO

        $this->render('register', ['model' => $model]);
        Yii::app()->end();
    }

}
