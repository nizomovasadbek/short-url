<?php

class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {

        $username = strtolower($this->username);
        $user = User::model()->find('LOWER(username)=?', [$username]);

        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->password != $this->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user->id;
            $this->username = $user->id;
            $this->password = $user->password;
            $this->errorCode = self::ERROR_NONE;
        }

        return self::ERROR_NONE == $this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}
