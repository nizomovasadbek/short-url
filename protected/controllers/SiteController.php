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
        
    }

}
