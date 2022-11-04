<?php

class AdminController extends Controller {

    private function checkOut($user_id1, $user_id2) {
        $user1 = User::model()->findByPk($user_id1);
        $user2 = User::model()->findByPk($user_id2);
        if ($user1 === null || $user2 === null) {
            echo Yii::t("translation", "user_is_not_exist") . '<br>';
            Yii::app()->end();
        }
        if ($user1->role == 'admin' && $user2->role == 'admin') {
            echo Yii::t("translation", "you_cant_update") . " {$user1->username}";
            Yii::app()->end();
        }
    }

    public function filters() {
        return [
            'accessControl'
        ];
    }

    public function accessRules() {
        return [
                ['allow',
                'actions' => ['files'],
                'roles' => ['super']
            ],
                ['allow',
                'actions' => ['index', 'delete', 'update', 'show', 'import'],
                'roles' => ['admin']
            ],
                ['deny',
                'users' => ['*']
            ]
        ];
    }

    public function actionFiles() {
        
    }

    public function actionShow($id) {
        Yii::app()->user->changeLastActivity();
        if (Yii::app()->user->id == $id) {
            echo Yii::t('translation', 'you_cant_delete_yourself');
            Yii::app()->end();
        }
        $user = User::model()->findByPk($id);

        $this->checkOut($id, Yii::app()->user->id);

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
        $criteria = new CDbCriteria();
        if (Yii::app()->user->role == 'admin') {
            $criteria->condition = "role = 'user' or role = 'admin'";
        }
        $users = User::model()->findAll($criteria);
        $this->render('index', ['users' => $users]);
        Yii::app()->end();
    }

    public function actionDelete($id) {
        Yii::app()->user->changeLastActivity();
        $this->checkOut($id, Yii::app()->user->id);
        $user = User::model()->findByPk($id);
        if ($user === null) {
            echo Yii::t('translation', 'user_not_found');
            Yii::app()->end();
        }
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user->id);
        $link = Link::model()->findAll($criteria);
        if ($link === null) {
            echo Yii::t('translation', 'given_specific_user_didnt_create_any_short_urls');
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
        Yii::app()->user->changeLastActivity();
        $this->checkOut($id, Yii::app()->user->id);
        $user = User::model()->findByPk($id);
        if ($user === null) {
            echo Yii::t('translation', 'user_not_found');
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
        Yii::app()->user->changeLastActivity();
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
                ->setTitle(Yii::t('translation', 'users_data'))
                ->setSubject(Yii::t('translation', 'information_about_users'))
                ->setDescription(Yii::t('translation', 'excel_file_downloaded_by') . "{$user->username}")
                ->setKeywords(Yii::t('translation', 'office'))
                ->setCategory(Yii::t('translation', 'information_about_users'));
        $obj_php_excel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID')
                ->setCellValue('B1', Yii::t('translation', 'username'))
                ->setCellValue('C1', Yii::t('translation', 'role'))
                ->setCellValue('D1', Yii::t('translation', 'last_activity'));

        $criteria = new CDbCriteria();
        if (Yii::app()->user->role == 'admin') {
            $criteria->condition = "role = 'user' or role = 'admin'";
        }
        $users = User::model()->findAll($criteria);
        $coord = 2;
        foreach ($users as $all) {
            $obj_php_excel->getActiveSheet()
                    ->setCellValue("A{$coord}", $all->id)
                    ->setCellValue("B{$coord}", $all->username)
                    ->setCellValue("C{$coord}", $all->last_activity)
                    ->setCellValue("D{$coord}", $all->role);
            $coord++;
        }

        $obj_php_excel->getActiveSheet()->setTitle('Shorturl users');
        $obj_php_excel->setActiveSheetIndex(0);
        //write in Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($obj_php_excel, 'Excel2007');
        $fileName = Yii::app()->randstr->getRandomString(32);
        $objWriter->save(__DIR__ . "/../../upload/{$fileName}.xlsx");
        $filePath = __DIR__ . "/../../upload/{$fileName}.xlsx";
        $file = new File();
        $file->name = $fileName;
        $file->create_time = $file->update_time = date('Y-m-d H:i:s');
        $file->path = $filePath;
        $file->user_id = $user->id;
        $file->save();
        $this->render('import', ['fileName' => $fileName]);
        Yii::app()->end();
    }

}
