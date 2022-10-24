<?php

class AdminController extends Controller {

    public function filters() {
        return array(
            'accessControl'
        );
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('index'),
                'roles' => array('admin')
            ),
            array('deny',
                'users' => ['*']
            )
        );
    }

    public function actionIndex() {
        Yii::app()->user->changeLastActivity();
        $users = User::model()->findAll();
        $this->render('index', ['users' => $users]);
        Yii::app()->end();
    }

}
