<?php

class WebUser extends CWebUser {

    private $_model = null;

    private function getModel() {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = User::model()->findByPk($this->id);
        }

        return $this->_model;
    }

    public function getRole() {
        if ($user = $this->getModel()) {
            return $user->role;
        }
    }

    public function changeLastActivity() {
        if ($user = $this->getModel()) {
            $user->last_activity = date('Y-m-d H:i:s');
            $user->saveAttributes(['last_activity']);
        }
    }

}
