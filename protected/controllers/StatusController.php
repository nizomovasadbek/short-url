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
                'roles' => ['user']
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

    public function actionDownload($url) {
        Yii::app()->user->changeLastActivity();
        $user = User::model()->findByPk(Yii::app()->user->id);
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user->id);
        $criteria->compare('name', $url);
        $criteria->order = 'create_time DESC';
        $file = File::model()->find($criteria);
        $filePath = $file->path;
        if (!file_exists($filePath)) {
            echo Yii::t('translation', 'file_doesnt_exist_or_deleted');
            Yii::app()->end();
        }
        $report = Yii::t('translation', 'report');
        Yii::app()->getRequest()->sendFile("{$report}.xlsx", @file_get_contents($filePath));
        Yii::app()->end();
    }

}
