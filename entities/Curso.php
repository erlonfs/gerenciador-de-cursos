<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Curso
 *
 * @author Erlon
 */
class Curso {  
    
    private $id;
    private $nome_local;
    private $endereco;
    private $numero;
    private $bairro;
    private $cep;
    private $cidade;
    private $cidade_nome;
    private $estado;
    private $estado_nome;
    private $detentor;
        
    
    /////////////GETTERS//////////////
    public function getId(){
        return $this->id;
    }    
    public function getNomeLocal(){
        return $this->nome_local;
    }
    public function getEndereco(){
        return $this->endereco;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function getBairro(){
        return $this->bairro;
    }
    public function getCep(){
        return $this->cep;
    }
    public function getCidade(){
        return $this->cidade;
    }
    public function getEstado(){
        return $this->estado;            
    }    
    public function getCidadeNome(){
        return $this->cidade_nome;
    }
    public function getEstadoNome(){
        return $this->estado_nome;
    }    
    public function getDetentor(){
        return $this->detentor;
    }
    
    /////////////SETTERS///////////////
    
    public function setId($id){
        $this->id = $id;
    }    
    public function setNomeLocal($nome_local){
        $this->nome_local = $nome_local;
    }
    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }
    public function setNumero($numero){
        $this->numero = $numero;
    }
    public function setBairro($bairro){
        $this->bairro = $bairro;
    }
    public function setCep($cep){
        $this->cep = $cep;
    }
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }        
    public function setCidadeNome($cidade){
        $this->cidade_nome = $cidade;
    }
    public function setEstadoNome($estado){
        $this->estado_nome = $estado;
    }    
    public function setDetentor($detentor){
        $this->detentor = $detentor;
    }
}

?>
