<?php
namespace Library\Exception;

use Library\Loghandler\Log;
/**
 * Description of ExceptionApigility
 *
 * @author Hagamenon <haganicolau@gmail.com>
 * @date 12/07/2019
 */
class ExceptionApigility extends \Exception 
{        
    /**
    * Construtor que usa informações compartilhadas da classe pai
    *
    * @param  $message mensagem de exceção
    * @param  $code código http
    * @param  $previous stack de exceção 
    * @return void
    *
    */
    public function __construct (
        $message, 
        $code = 0, 
        \Exception $previous = null
    ) {
        
        $this->message = $message;
        $this->code = $code;
        $this->previous = $previous;
        
        switch ($this->code){
            case 500:
                $level = Log::ERORR;
                break;
            
            case 400:
                $level = Log::INFO;
                break;
            
            default :
                $level = Log::INFO;
                
        }
        
        $this->createLog($level); 
        parent::__construct($message, $code, $previous);
    }
    
    /**
    * Apresenta texto string da exceção
    *
    * @return string
    *
    */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
    
    /**
    * cria o log da exceção
    *
    * @param  $level tipo de exceção
    * @return void
    *
    */
    public function createLog($level) {
       Log::create($level, $this->message, $this->code);
    }
    
    
}
