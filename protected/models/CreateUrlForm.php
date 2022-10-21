<?php

class CreateUrlForm extends CFormModel {

    public $url;

    public function rules() {
        return ['url', 'safe', 'on' => 'search'];
    }

}
