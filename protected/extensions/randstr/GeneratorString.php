<?php

class GeneratorString {
    
    public function init(){
        
    }

    public function getRandomString($len = 12){
        $randomCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for($i = 0; $i < $len; $i++){
            $str = $str . $randomCharacters[rand(0, strlen($randomCharacters)-1)];
        }
        
        return $str;
    }

    
}
