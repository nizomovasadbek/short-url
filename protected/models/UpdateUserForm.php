<?php

class UpdateUserForm extends CFormModel {
    public $role;
    
    public function rules(){
        return array(
            array('role', 'safe', 'on'=>'search'),
            array('role', 'length', 'max' => 20)
        );
    }
}