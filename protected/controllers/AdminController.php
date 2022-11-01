<?php

class AdminController extends Controller {

    public function filters() {
        return array('accessControl');
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'delete'),
                'roles' => array('admin')
            ),
            array('deny',
                'users' => array('*')
            )
        );
    }

    public function actionIndex() {
        //admin rules
        Yii::app()->user->changeLastActivity();
        $users = User::model()->findAll();
        $this->render('index', ['users' => $users]);
        Yii::app()->end();
    }

    public function actionDelete($id) {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user->id);
        $link = Link::model()->findAll($criteria);
        foreach ($link as $l) {
            $l->delete();
        }
        $user->delete();
    }

}
