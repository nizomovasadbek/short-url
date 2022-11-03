<?php

class Generator {
    
    public function getRandomString($len = 12){
        $randomCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for($i = 0; $i < $len; $i++){
            $str .= $randomCharacters[rand(0, strlen($randomCharacters))];
        }
        
        return $str;
    }

    
}