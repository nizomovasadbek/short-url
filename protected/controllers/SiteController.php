<?php

class SiteController extends Controller {

    public function actionError() {
        $this->render('error');
        Yii::app()->end();
    }

    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->render('guest');
            Yii::app()->end();
        }
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('user', ['user' => $user]);
    }

}
