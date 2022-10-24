<?php

class MyController extends Controller {

    public function filters() {
        return array(
            'accessControl'
        );
    }

    public function accessRules() {
        return [
                ['allow',
                'actions' => ['index'],
                'roles' => ['user']
            ],
                ['deny',
                'users' => ['*']
            ]
        ];
    }

    public function actionIndex() {
        Yii::app()->user->changeLastActivity();
        $user = User::model()->findByPk(Yii::app()->user->id);
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user->id);
        $links = Link::model()->findAll($criteria);
        $this->render('index', ['links'=>$links]);
        Yii::app()->end();
    }

}
