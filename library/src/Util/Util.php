<?php

namespace Library\Util;

use \Library\Exception\ExceptionApigility;

/**
 * Description of Util
 *
 * @author Hagamenon <haganicolau@gmail.com>
 * @date 20/07/2019
 */
class Util {
    
    /**
     * Verifica se e-mail é válido
     *
     * @param  string $email
     * @return boolean | ExceptionApigility
     */
    public static function validateEmail($email)
    {
        $validate = preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email);
        
        if(!$validate) {
            false;
        }
        return true;
    }
    
    /**
     * Verifica força da senha
     *
     * @param  string $password
     * @return boolean | ExceptionApigility
     */
    public static function validateStrengthPass($password)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
//        $specialChars = preg_match('@[^\w]@', $password);
        
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            throw new ExceptionApigility(
                StatusMessage::PASS_NOT_STRONG_ENOUGH,
                400
            );
        }
        
        return true;

    }
    
    /**
     * Valida se o modo desenvoledor está ativo ou não
     *
     * @return boolean 
     */
    public static function isDevelopmentEnable()
    {
        $filename = realpath('config/development.config.php');
        if(file_exists($filename)) {
            return true;
        }
        return false;
    }
}
