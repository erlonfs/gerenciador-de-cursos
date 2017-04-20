<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Participante
 *
 * @author Erlon
 */
class Participante {

    //put your code here    
    private $id;
    private $nome;
    private $cpf_cnpj;
    private $data_nasc;
    private $sexo;
    private $endereco;
    private $numero;
    private $bairro;
    private $cep;
    private $cidade;
    private $cidadeTexto;
    private $estado;
    private $estadoSigla;
    private $estadoTexto;
    private $complemento;
    private $telefone;
    private $celular1;
    private $celular2;
    private $celular3;
    private $email1;
    private $email2;
    private $nome_mae_responsavel;
    private $nome_pai_responsavel;
    private $estado_civil;
    private $nome_conjuge;
    private $profissao;
    private $instituicao_nome;
    private $instituicao_endereco;
    private $instituicao_numero;
    private $instituicao_bairro;
    private $instituicao_cep;
    private $instituicao_cidade;
    private $instituicao_cidadeTexto;
    private $instituicao_estado;
    private $instituicao_estadoTexto;
    private $info_sacramento;
    private $setor;
    private $veiculo;
    private $funcao_missao;
    private $local_curso;
    private $observacoes;
    private $semestre;
    private $detentor;

    /////////////GETTERS//////////////
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
    
    public function getCpfCnpj() {
        return $this->cpf_cnpj;
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

    public function getSexoTexto() {
        return $this->sexo == 'M' ? 'Masculino' : 'Feminino';
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
    
    public function getCidadeTexto() {
        return $this->cidadeTexto;
    }

    public function getEstado() {
        return $this->estado;
    }
    
    public function getEstadoSigla() {
        return $this->estadoSigla;
    }
    
    public function getEstadoTexto() {
        return $this->estadoTexto;
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

    public function getNomeMae() {
        return $this->nome_mae_responsavel;
    }

    public function getNomePai() {
        return $this->nome_pai_responsavel;
    }

    public function getEstadoCivil() {
        return $this->estado_civil;
    }

    public function getNomeConjugue() {
        return $this->nome_conjuge;
    }

    public function getProfissao() {
        return $this->profissao;
    }

    public function getInstituicaoNome() {
        return $this->instituicao_nome;
    }

    public function getInstituicaoEndereco() {
        return $this->instituicao_endereco;
    }

    public function getInstituicaoNumero() {
        return $this->instituicao_numero;
    }

    public function getInstituicaoBairro() {
        return $this->instituicao_bairro;
    }

    public function getInstituicaoCep() {
        return $this->instituicao_cep;
    }

    public function getInstituicaoCidade() {
        return $this->instituicao_cidade;
    }
    
    public function getInstituicaoCidadeTexto() {
        return $this->instituicao_cidadeTexto;
    }

    public function getInstituicaoEstado() {
        return $this->instituicao_estado;
    }
    
    public function getInstituicaoEstadoTexto() {
        return $this->instituicao_estadoTexto;
    }

    public function getInfoSacramento() {
        return $this->info_sacramento;
    }

    public function getSetor() {
        return $this->setor;
    }

    public function getVeiculo() {
        return $this->veiculo;
    }

    public function getFuncaoMissao() {
        return $this->funcao_missao;
    }

    public function getLocalCurso() {
        return $this->local_curso;
    }
    
    public function getObservacoes() {
        return $this->observacoes;
    }   
    
    public function getSemestre() {
        return $this->semestre;
    }
    
    public function getDetentor() {
        return $this->detentor;
    }

    /////////////SETTERS///////////////

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setCpfCnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
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
    
    public function setCidadeTexto($cidadeTexto) {
        $this->cidadeTexto = $cidadeTexto;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
    public function setEstadoSigla($estadoSigla) {
        $this->estadoSigla = $estadoSigla;
    }
    
    public function setEstadoTexto($estadoTexto) {
        $this->estadoTexto = $estadoTexto;
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

    public function setNomeMae($nome_mae_responsavel) {
        $this->nome_mae_responsavel = $nome_mae_responsavel;
    }

    public function setNomePai($nome_pai_responsavel) {
        $this->nome_pai_responsavel = $nome_pai_responsavel;
    }

    public function setEstadoCivil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    public function setNomeConjugue($nome_conjuge) {
        $this->nome_conjuge = $nome_conjuge;
    }

    public function setProfissao($profissao) {
        $this->profissao = $profissao;
    }

    public function setInstituicaoNome($instituicao_nome) {
        $this->instituicao_nome = $instituicao_nome;
    }

    public function setInstituicaoEndereco($instituicao_endereco) {
        $this->instituicao_endereco = $instituicao_endereco;
    }

    public function setInstituicaoNumero($instituicao_numero) {
        $this->instituicao_numero = $instituicao_numero;
    }

    public function setInstituicaoBairro($instituicao_bairro) {
        $this->instituicao_bairro = $instituicao_bairro;
    }

    public function setInstituicaoCep($instituicao_cep) {
        $this->instituicao_cep = $instituicao_cep;
    }

    public function setInstituicaoCidade($instituicao_cidade) {
        $this->instituicao_cidade = $instituicao_cidade;
    }
    
    public function setInstituicaoCidadeTexto($InstituicaocidadeTexto) {
        $this->InstituicaocidadeTexto = $InstituicaocidadeTexto;
    }

    public function setInstituicaoEstado($instituicao_estado) {
        $this->instituicao_estado = $instituicao_estado;
    }
    
    public function setInstituicaoEstadoTexto($instituicao_estadoTexto) {
        $this->instituicao_estadoTexto = $instituicao_estadoTexto;
    }

    public function setInfoSacramento($info_sacramento) {
        $this->info_sacramento = $info_sacramento;
    }

    public function setSetor($setor) {
        $this->setor = $setor;
    }

    public function setVeiculo($veiculo) {
        $this->veiculo = $veiculo;
    }

    public function setFuncaoMissao($funcao_missao) {
        $this->funcao_missao = $funcao_missao;
    }

    public function setLocalCurso($local_curso) {
        $this->local_curso = $local_curso;
    }
    
    public function setObservacoes($observacoes) {
        $this->observacoes = $observacoes;
    }
    
    public function setSemestre($semestre) {
        $this->semestre = $semestre;
    }

    public function setDetentor($detentor) {
        $this->detentor = $detentor;
    }

}

?>
