<?php

class CreateUrlForm extends CFormModel {

    public $url;

    public function rules() {
        return array(
            array('url', 'url')
        );
    }

}
