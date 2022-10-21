<?php

class RegisterForm extends CFormModel {

    public $username;
    public $password;
    public $rememberMe;

    public function rules() {
        return array(
                ['username', 'length', 'max' => 90],
                ['password', 'length', 'max' => 255],
                ['rememberMe', 'boolean'],
                ['username, password, rememberMe', 'safe', 'on' => 'search']
        );
    }

}
