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
                'actions' => ['index', 'delete', 'update', 'show', 'import'],
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
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user->id);
        $links_that_belongs_to_user = Link::model()->findAll($criteria);
        if ($user === null) {
            $this->redirect('/admin');
            Yii::app()->end();
        }
        $this->render('show', ['user' => $user, 'links' => $links_that_belongs_to_user]);
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
                if ($model->role == 0) {
                    $user->role = 'admin';
                } else if ($model->role == 1) {
                    $user->role = 'user';
                }
            }
            $user->update_time = date('Y-m-d H:i:s');
            $user->saveAttributes(['role', 'update_time']);
            $this->redirect('/admin');
            Yii::app()->end();
        }

        $this->render('update', ['model' => $model, 'user' => $user]);
        Yii::app()->end();
    }

    public function actionImport() {
        Yii::import('application.extensions.phpexcel.Classes.PHPExcel');
        $user = User::model()->findByPk(Yii::app()->user->id);
        if ($user === null) {
            $this->redirect('/');
            Yii::app()->end();
        }
        Yii::app()->user->changeLastActivity();
        $obj_php_excel = new PHPExcel();
        $obj_php_excel->getProperties()->setCreator("Shorturl (C)")
                ->setLastModifiedBy('Shorturl (C)')
                ->setTitle('Users\' data')
                ->setSubject("Informations about Users")
                ->setDescription("Excel file downloaded by {$user->username}")
                ->setKeywords('Office')
                ->setCategory('Datas about users');
        $obj_php_excel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Id')
                ->setCellValue('B1', 'Username')
                ->setCellValue('C1', 'Last activity')
                ->setCellValue('D1', 'Role');

        $criteria = new CDbCriteria();
        $criteria->condition = "id != :id";
        $criteria->params = array(
            ':id' => $user->id
        );
        $users = User::model()->findAll($criteria);
        $index = 0;
        foreach($users as $coord=>$all){
            $obj_php_excel->getActiveSheet()
                    ->setCellValue("A{$coord}", $all->id)
                    ->setCellValue("B{$coord}", $all->username)
                    ->setCellValue("C{$coord}", $all->last_activity)
                    ->setCellValue("D{$coord}", $all->role);
        }

        $obj_php_excel->getActiveSheet()->setTitle('Shorturl users');
        $obj_php_excel->setActiveSheetIndex(0);
        //write in Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($obj_php_excel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', '/../../result.php'));

        echo 'successfully imported';
        Yii::app()->end();
    }

}
