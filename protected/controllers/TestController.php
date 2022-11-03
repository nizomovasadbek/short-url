<?php

class TestController extends Controller {

    public function actionIndex() {
        Yii::app()->qrcode->create('https://google.com');
        Yii::app()->end();
    }

}
