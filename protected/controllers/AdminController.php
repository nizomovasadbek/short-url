<?php

class AdminController extends Controller {

    public function filters() {
        return [
            'accessControl'
        ];
    }

    public function accessRules() {
        return [
                ['allow',
                'actions' => ['index', 'delete', 'update', 'show'],
                'roles' => ['admin']
            ],
                ['deny',
                'users' => ['*']
            ]
        ];
    }

    public function actionShow($id) {
        Yii::app()->user->changeLastActivity();
        if (Yii::app()->user->id == $id) {
            echo "You can't delete yourself:)";
            Yii::app()->end();
        }
        $user = User::model()->findByPk($id);
        if ($user === null) {
            $this->redirect('/admin');
            Yii::app()->end();
        }
        $this->render('show', ['user' => $user]);
        Yii::app()->end();
    }

    public function actionIndex() {
        Yii::app()->user->changeLastActivity();
        $users = User::model()->findAll();
        $this->render('index', ['users' => $users]);
        Yii::app()->end();
    }

    public function actionDelete($id) {
        $user = User::model()->findByPk($id);
        if ($user === null) {
            echo "User not found";
            Yii::app()->end();
        }
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user->id);
        $link = Link::model()->findAll($criteria);
        if ($link === null) {
            echo "given specific user didn't create any short urls";
            Yii::app()->end();
        }
        foreach ($link as $l) {
            $l->delete();
        }
        $user->delete();
        $this->redirect('/admin');
        Yii::app()->end();
    }

    public function actionUpdate($id) {
        $user = User::model()->findByPk($id);
        if ($user === null) {
            echo "User not found";
            Yii::app()->end();
        }
        $model = new UpdateUserForm();

        if (isset($_POST['UpdateUserForm'])) {
            $model->attributes = $_POST['UpdateUserForm'];
            if ($model->validate()) {
                if ($model->role == 1) {
                    $user->role = 'admin';
                } else if ($model->role == 2) {
                    $user->role = 'user';
                }
                $user->update_time = date('Y-m-d H:i:s');
            }
            $user->saveAttributes(['role', 'update_time']);
            $this->redirect('/admin');
            Yii::app()->end();
        }

        $this->render('update', ['model' => $model]);
        Yii::app()->end();
    }

}
