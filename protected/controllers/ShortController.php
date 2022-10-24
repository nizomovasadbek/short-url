<?php

class ShortController extends Controller {

    public function actionIndex() {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->user->changeLastActivity();
        }
        $this->redirect('/');
        Yii::app()->end();
    }

    public function actionView($url) {
        
    }

    public function actionNew() {
        $model = new CreateUrlForm();

        
        
        $this->render('new', ['model' => $model]);
        Yii::app()->end();
    }

}
