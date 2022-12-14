<?php

class ShortController extends Controller {

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
                ['allow',
                'actions' => ['view'],
                'roles' => ['guest']
            ],
                ['deny',
                'users' => ['*']
            ]
        ];
    }

    public function actionView($url) {
        if (!Yii::app()->user->isGuest)
            Yii::app()->user->changeLastActivity();
        $criteria = new CDbCriteria();
	$short_url = 'http://' . $_SERVER['HTTP_HOST'] . '/short/' . $url;
	Yii::log("Redirecting to $short_url", CLogger::LEVEL_ERROR);
        $criteria->compare('short_url', $short_url);
        $link = Link::model()->find($criteria);
        if ($link === null) {
            $this->redirect('/site/error');
            Yii::app()->end();
        }
        $redirect_url = $link->url;
        $this->redirect($redirect_url);
        Yii::app()->end();
    }

    public function actionIndex() {
        Yii::app()->user->changeLastActivity();
        $model = new CreateUrlForm();
        $user = User::model()->findByPk(Yii::app()->user->id);
        $link = new Link();

        if (isset($_POST['CreateUrlForm'])) {
            $model->attributes = $_POST['CreateUrlForm'];
            $link->url = $model->url;
            $link->user_id = $user->id;
            $short_url = 'http://' . $_SERVER['HTTP_HOST'] . '/short/' . Yii::app()->randstr->getRandomString();
            $link->short_url = $short_url;
            $link->create_time = $link->update_time = date('Y-m-d H:i:s');
            if ($link->save()) {
                $this->render('result', ['url' => $short_url]);
                Yii::app()->end();
            }
        }

        $this->render('new', ['model' => $model]);
        Yii::app()->end();
    }

}
