<?php

class AuthController extends Controller {

    private $iden;

    public function actionIndex() {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->user->changeLastActivity();
        }
        $this->redirect('/');
        Yii::app()->end();
    }

    public function actionLogout() {
        if (Yii::app()->user->isGuest) {
            $this->redirect('/');
            Yii::app()->end();
        }

        Yii::app()->user->changeLastActivity();
        Yii::app()->user->logout();
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

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate()) {
                $user->username = $model->username;
                $user->password = md5($model->password);
                $this->iden = new UserIdentity($user->username, $user->password);
                if ($this->iden->authenticate()) {
                    Yii::app()->user->login($this->iden);
                    $user = User::model()->findByPk(Yii::app()->user->id);
                    Yii::app()->user->changeLastActivity();
                }
                $this->redirect('/');
                Yii::app()->end();
            }
        }

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

        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            if ($model->validate()) {
                $user->username = $model->username;
                $user->password = $model->password;
                $user->role = 'user';
                $user->last_activity = $user->create_time = $user->update_time = date('Y-m-d H:i:s');
                if ($user->save()) {
                    $this->iden = new UserIdentity($user->username, $user->password);
                    if ($this->iden->authenticate()) {
                        Yii::app()->user->login($this->iden);
                    }
                    $this->redirect('/');
                    Yii::app()->end();
                }
            }
        }

        $this->render('register', ['model' => $model]);
        Yii::app()->end();
    }

}
