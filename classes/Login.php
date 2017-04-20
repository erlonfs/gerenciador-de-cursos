<?php

include_once 'Conexao.php';
include_once 'data/UsuarioDAO.php';
include_once 'entities/Usuario.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author Erlon
 */
class Login {
    //put your code here
    private static $conn;
    private static $sucesso = false;
    
    private $user_id;
    private $user_nome;
    private $user_login;    
    private $user_tipo;    
    private $user_semestre;  
    


    public function __construct() {
        self::$conn = new Conexao();
    }


    public function Logar($strLogin, $strSenha){
           
        $mensagem = self::ValidarLogin($strLogin, $strSenha);
        if($mensagem != ''){
            $this->sucesso = false;
        }else{
            
            $dao = new UsuarioDAO();
            $qtd = $dao->Count(sprintf("where login = '%s' and senha = '%s'", $strLogin, $strSenha));
                       
            
            if($qtd > 0){                
                $usuario = $dao->getList(sprintf("where login = '%s' and senha = '%s'", $strLogin, $strSenha));
                $this->user_id = $usuario[0]->getId();
                $this->user_nome = $usuario[0]->getNome();
                $this->user_login = $usuario[0]->getLogin();
                $this->user_tipo = $usuario[0]->getTipo();                
                $this->user_semestre = $usuario[0]->getSemestre();
                $this->sucesso = true; 
            }else{
                $this->sucesso = false;
                $mensagem = 'Login ou Senha Inválidos!';
            }                                               
        }
        
        return $mensagem;
        
    }
    
    private function ValidarLogin($strLogin, $strSenha){
        $msg = '';
        if($strLogin == ''){
            $msg = 'Preencha o campo Login.<br/>';            
        }        
        
        if($strSenha == ''){
            $msg .= 'Preencha o campo Senha.<br/>';            
        }
        
        return $msg;
    }
    
    public function isSucesso(){
        return $this->sucesso;        
    }
    
    public function getUserId(){
        return $this->user_id;
    }
    
    public function getUserNome(){
        return $this->user_nome;
    }
    
    public function getUserLogin(){
        return $this->user_login;
    }    
    
    public function getUserTipo(){
        return $this->user_tipo;
    }
    
    public function getUserSemestre(){
        return $this->user_semestre;
    }
    
}

?>
