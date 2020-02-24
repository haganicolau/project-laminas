<?php
namespace Library\Loghandler;
/**
 * Criação do log do sistema
 *
 * @author Hagamenon <haganicolau@gmail.com>
 * @date 11/07/2019
 */

class Log 
{
    
    public const DEBUG = 'debug';
    public const INFO = 'info';
    public const ERORR = 'error';
    
    /**
    * Cria o log 
    *
    * @param  $level define o tipo de log
    * @param  $note informações adicionais no log
    * @return void
    *
    */
    public static function create($level, $note, $code)
    {
        $stack = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $line = self::prepareStack($level, $stack, $note, $code);
        self::writeLogInFile($level.'.log', $line);
        return;
    }
    
    /**
    * Abre o arquivo e salva as informações no arquivo de log
    *
    * @param  $file - nome do arquivo
    * @param  $line - linha do log
    * @return void
    *
    */
    public function writeLogInFile($file, $line)
    {
        $directory = realpath('data/log') . '/' . $file;
        $handle = fopen($directory, 'a+');
        fwrite($handle, $line);
        fclose($handle);
        return;
    }
    
    /**
    * Prepara pilha de informações mais informaçẽos adicionais para serem
    * inseridas no LOG
    *
    * @param  $level define o tipo de log
    * @param  $stack pilha de informações que serão inseridas no log
    * @param  $note informações adicionais no log
    * @param  $code código http
    * @return $line string finalizada
    *
    */
    public function prepareStack(
        $level, 
        $stack, 
        $note,
        $code
    ){
        $line = date("Y-m-d H:i:s");
        
        if(!empty($code)){
            $line = $line . ' [HTTP CODE]: ' . $code;
        }
        
        $line = $line . ' [' . strtoupper($level) . ']: ' . $note;

        if($level === self::ERORR){
            $line = $line . ' [STACKTRACE]: ' . json_encode($stack);
        }
        $line = $line . " \n";
        return $line;
        
    }
}
