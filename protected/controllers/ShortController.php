<?php

class ShortController extends Controller {

    public function actionIndex() {
        if (!Yii::app()->user->isGuest) {
            Yii::app()->user->changeLastActivity();
        }
        $this->redirect('/');
        Yii::app()->end();
    }

}
