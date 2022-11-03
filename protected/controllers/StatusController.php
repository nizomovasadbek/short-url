<?php

class StatusController extends Controller {

    public function filters() {
        return [
            'accessControl'
        ];
    }

    public function accessRules() {
        return [
                [
                'allow',
                'actions' => ['index', 'download'],
                'roles' => ['admin']
            ],
                [
                'deny',
                'users' => ['*']
            ]
        ];
    }

    public function actionIndex() {
        Yii::app()->user->changeLastActivity();
        $this->redirect('/');
        Yii::app()->end();
    }

    public function actionDownload() {
        
    }

}
