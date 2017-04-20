<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Erlon
 */
class Usuario {

    //put your code here
    private $id;
    private $nome;
    private $data_nasc;
    private $sexo;
    private $endereco;
    private $numero;
    private $bairro;
    private $cep;
    private $cidade;
    private $estado;
    private $complemento;
    private $telefone;
    private $celular1;
    private $celular2;
    private $celular3;
    private $email1;
    private $email2;
    private $funcao_missao;
    private $login;
    private $senha;
    private $semestre;
    private $tipo;

    /////////////GETTERS//////////////

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDataNasc($formato = 0) {
        if (intval($formato) > 0) {
            $manipula = new ManipulaDados ();
            return $manipula->converteData($this->data_nasc, $formato);
        }
        
        return $this->data_nasc;        
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getCelular1() {
        return $this->celular1;
    }

    public function getCelular2() {
        return $this->celular2;
    }

    public function getCelular3() {
        return $this->celular3;
    }

    public function getEmail1() {
        return $this->email1;
    }

    public function getEmail2() {
        return $this->email2;
    }

    public function getFuncaoMissao() {
        return $this->funcao_missao;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }
    
    public function getSemestre() {
        return $this->semestre;
    }

    public function getTipo() {
        return $this->tipo;
    }

    /////////////SETTERS///////////////

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDataNasc($data_nasc) {
        $this->data_nasc = $data_nasc;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setCelular1($celular1) {
        $this->celular1 = $celular1;
    }

    public function setCelular2($celular2) {
        $this->celular2 = $celular2;
    }

    public function setCelular3($celular3) {
        $this->celular3 = $celular3;
    }

    public function setEmail1($email1) {
        $this->email1 = $email1;
    }

    public function setEmail2($email2) {
        $this->email2 = $email2;
    }

    public function setFuncaoMissao($funcao_missao) {
        $this->funcao_missao = $funcao_missao;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function setSemestre($semestre) {
        $this->semestre = $semestre;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

}

?>
