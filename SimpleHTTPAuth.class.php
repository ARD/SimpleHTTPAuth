<?php
###########################################################
# Simple HTTP Auth
# @autor Andre Rainaud <contato@andrerainaud.com.br>
# @version 0.1
###########################################################
class SimpleHTTPAuth {
    private $users = array();
    private $title;
    
    /**
     * Construtor
     * @param string [$title = 'Informe os dados de acesso'] Titulo da janela
     */
    public function __construct($title = 'Informe os dados de acesso'){
        $this->title = $title;
    }
    
    /**
     * Adiciona um novo usuario
     * @param string $login    
     * @param string $password
     * @return $this
     */
    public function addUser($login,$password){
        if (empty($login) || empty($password))
            die ('Informe um login e senha');
        
        if (!ctype_alpha($login))
            die ('O login nao pode conter caracter especial. Use somente letras!');
        
        $this->users[$login] = $password;
        return $this;
    }
    
    /**
     * Verifica se os dados de acesso estao corretos
     * @param   string $login    
     * @param   string $password 
     * @returns Boolean
     */
    private function login($login,$password){
        $login    = trim($login);
        $password = trim($password);
        
        if (empty($login) || empty($password))
            return false;
        
        if (!isset($this->users[$login]))
            return false;
        
        if ($this->users[$login] != $password)
            return false;
        
        return true;
    }
    
    /**
     * Verifica se o usuario esta autenticado
     */
    public function run(){
        
        $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
        
        if (!$this->login($user,$pass)){
            header('WWW-Authenticate: Basic realm="'.$this->title.'"');
            header('HTTP/1.0 401 Unauthorized');
            die ("Sem permissao!");
        }
        
    }
}
