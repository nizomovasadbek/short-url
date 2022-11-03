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

    private function createExcelFile($links){
        $obj = new PHPExcel();
        $obj->getProperties()->setCreator('Shorturl (C)')
            ->setLastModifiedBy('Shorturl')
            ->setSubject('My short links')
            ->setKeywords('Office')
            ->setDescription('Short url excel file')
            ->setCategory('My links');

        $obj->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Url')
            ->setCellValue('B1', 'Short url')
            ->setCellValue('C1', 'Created time');

        $coord = 2;
        foreach($links as $link){
            $obj->getActiveSheet()
                ->setCellValue("A{$coord}", $link->url)
                ->setCellValue("B{$coord}", $link->short_url)
                ->setCellValue("C{$coord}", "{$link->create_time}");
            $coord++;
        }

        $obj->getActiveSheet()->setTitle('My links');
        $obj->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $fileName = Yii::app()->randstr->getRandomString(32);
        $file = new File();
        $file->path = __DIR__ . "/../../upload/{$fileName}.xlsx";
        $file->name = $fileName;
        $file->create_time = $file->update_time = date('Y-m-d H:i:s');
        $file->user_id = Yii::app()->user->id;
        $file->save();
        $objWriter->save($file->path);
        $this->render('import', ['fileName' => $fileName]);
        Yii::app()->end();
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
