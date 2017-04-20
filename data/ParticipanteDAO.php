<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParticipanteDAO
 *
 * @author Erlon
 */
class ParticipanteDAO {

    private $conn;

    public function __construct() {
        $this->conn = new Conexao();
    }

    public function Salvar(Participante $participante) {
        if ($participante->getId() > 0) {
            $this->Update($participante);
        } else {
            $this->Insert($participante);
        }
    }

    private function Insert(Participante $participante) {

        $sql = "insert into tb_participante (nome, cpf_cnpj, data_nasc, sexo, endereco, numero, bairro, cep, 
                cidade, estado, complemento, telefone, celular1, celular2, celular3, email1, email2, 
                nome_mae_responsavel, nome_pai_responsavel, estado_civil, nome_conjuge, profissao, 
                instituicao_nome, instituicao_endereco, instituicao_numero, instituicao_bairro, 
                instituicao_cep, instituicao_cidade, instituicao_estado, info_sacramento, setor, 
                veiculo, observacoes, detentor) values ('%s', '%s','%s', '%s', '%s', '%s', '%s', '%s', %s, %s, '%s', '%s', '%s', '%s', '%s',
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, %s, %s, %s, %s, '%s', %s)";

        $result = $this->conn->execSQL(sprintf($sql, 
                  $participante->getNome(), 
                  $participante->getCpfCnpj(),
                  $participante->getDataNasc(), 
                  $participante->getSexo(), 
                  $participante->getEndereco(), 
                  $participante->getNumero(), 
                  $participante->getBairro(), 
                  $participante->getCep(), 
                  $participante->getCidade(), 
                  $participante->getEstado(), 
                  $participante->getComplemento(), 
                  $participante->getTelefone(), 
                  $participante->getCelular1(), 
                  $participante->getCelular2(), 
                  $participante->getCelular3(), 
                  $participante->getEmail1(), 
                  $participante->getEmail2(), 
                  $participante->getNomeMae(), 
                  $participante->getNomePai(), 
                  $participante->getEstadoCivil(), 
                  $participante->getNomeConjugue(), 
                  $participante->getProfissao(), 
                  $participante->getInstituicaoNome(), 
                  $participante->getInstituicaoEndereco(), 
                  $participante->getInstituicaoNumero(), 
                  $participante->getInstituicaoBairro(), 
                  $participante->getInstituicaoCep(), 
                  $participante->getInstituicaoCidade(), 
                  $participante->getInstituicaoEstado(), 
                  $participante->getInfoSacramento(), 
                  $participante->getSetor(), 
                  $participante->getVeiculo(),
                  $participante->getObservacoes(),
                  $participante->getDetentor()));
              
        
        $participante->setId(mysql_insert_id());
        
        $this->associarSemestre($participante);
       
    }

    private function Update(Participante $participante) {


        $sql = "update tb_participante t set t.nome = '%s', t.cpf_cnpj = '%s', t.data_nasc = '%s', t.sexo = '%s', t.endereco = '%s', 
               t.numero = '%s', t.bairro = '%s', t.cep = '%s', t.cidade = %s, t.estado = %s, t.complemento = '%s', 
               t.telefone = '%s', t.celular1 = '%s', t.celular2 = '%s', t.celular3 = '%s', t.email1 = '%s', 
               t.email2 = '%s', t.nome_mae_responsavel = '%s', t.nome_pai_responsavel = '%s', t.estado_civil = '%s', 
               t.nome_conjuge = '%s', t.profissao = '%s', t.instituicao_nome = '%s', t.instituicao_endereco = '%s', 
               t.instituicao_numero = '%s', instituicao_bairro = '%s', t.instituicao_cep = '%s', t.instituicao_cidade = %s, 
               t.instituicao_estado = %s, t.info_sacramento = %s, t.setor = %s, t.veiculo = %s, t.observacoes = '%s', t.detentor = %s
               where t.id = %s";

        $result = $this->conn->execSQL(sprintf($sql, $participante->getNome(), $participante->getCpfCnpj(), $participante->getDataNasc(), $participante->getSexo(), $participante->getEndereco(), $participante->getNumero(), $participante->getBairro(), $participante->getCep(), $participante->getCidade(), $participante->getEstado(), $participante->getComplemento(), $participante->getTelefone(), $participante->getCelular1(), $participante->getCelular2(), $participante->getCelular3(), $participante->getEmail1(), $participante->getEmail2(), $participante->getNomeMae(), $participante->getNomePai(), $participante->getEstadoCivil(), $participante->getNomeConjugue(), $participante->getProfissao(), $participante->getInstituicaoNome(), $participante->getInstituicaoEndereco(), $participante->getInstituicaoNumero(), $participante->getInstituicaoBairro(), $participante->getInstituicaoCep(), $participante->getInstituicaoCidade(), $participante->getInstituicaoEstado(), $participante->getInfoSacramento(), $participante->getSetor(), $participante->getVeiculo(), $participante->getObservacoes(),  $participante->getDetentor(), $participante->getId()));

        $this->associarSemestre($participante);
    }

    public function associar($cursosAssociado) {      
        
        $sql = "delete from tb_curso_associado where participante = %s and semestre = %s";

        $this->conn->execSQL(sprintf($sql, $cursosAssociado[0]->participante, $_SESSION['usuario_semestre']));

        
        for($i = 0; $i < sizeof($cursosAssociado); $i++){
                $sql = "insert into tb_curso_associado (participante, curso, funcao, semestre) values(%s, %s, %s, %s)";
                
                $this->conn->execSQL(sprintf($sql,
                       $cursosAssociado[$i]->participante,
                       $cursosAssociado[$i]->curso,
                       $cursosAssociado[$i]->funcao,
                       $_SESSION['usuario_semestre']));                
        }
    }
    
    public function obterCursoAssociado($participante) {
        $cursoAssociados = array();
                
        $sql = "select t.id, t.participante, t.curso, c.nome_local curso_texto, t.funcao, 
                lc.texto funcao_texto from tb_curso_associado t, tb_curso c, lv_curso_funcao lc 
                where t.participante = %s and c.id = t.curso and lc.id = t.funcao and t.semestre = %s";
        
        $qr = $this->conn->execSQL(sprintf($sql, $participante, $_SESSION['usuario_semestre']));
        
        $i = 0;

        while ($result = $this->conn->listQr($qr)) {
            $cursoAssociado = new CursoAssociado();
            $cursoAssociado->id = $result["id"];
            $cursoAssociado->curso = $result["curso"];
            $cursoAssociado->cursoTexto = $result["curso_texto"];
            $cursoAssociado->funcao = $result["funcao"];
            $cursoAssociado->funcaoTexto = $result["funcao_texto"];
            $cursoAssociado->participante = $result["participante"];
            
            $cursoAssociados[$i] = $cursoAssociado;
            $i++;
        }
        
        return $cursoAssociados;
    }    
    
    public function associarSemestre($participante) {                              
        $sql = 'select count(*) qtd from tb_participante_semestre where participante = %s and semestre = %s';        
        
        $qr = $this->conn->execSQL(sprintf($sql,$participante->getId(),$participante->getSemestre()));                        
        $result = $this->conn->listQr($qr);

        if($result["qtd"] == 0){                 
            $sql = "insert into tb_participante_semestre (participante, semestre) values(%s, %s)";                
            $this->conn->execSQL(sprintf($sql,$participante->getId(),$participante->getSemestre()));             
        }        
    }
    
    public function obterFuncaoMissao($participante) {
        $cursoAssociados = array();
                
        $sql = "select t.id, t.participante, t.curso, c.nome_local curso_texto, t.funcao, 
                lc.texto funcao_texto from tb_curso_associado t, tb_curso c, lv_curso_funcao lc 
                where t.participante = %s and c.id = t.curso and lc.id = t.funcao and t.semestre = %s";
        
        $qr = $this->conn->execSQL(sprintf($sql, $participante, $_SESSION['usuario_semestre']));
        
        $i = 0;

        while ($result = $this->conn->listQr($qr)) {
            $cursoAssociado = new CursoAssociado();
            $cursoAssociado->id = $result["id"];
            $cursoAssociado->curso = $result["curso"];
            $cursoAssociado->cursoTexto = $result["curso_texto"];
            $cursoAssociado->funcao = $result["funcao"];
            $cursoAssociado->funcaoTexto = $result["funcao_texto"];
            $cursoAssociado->participante = $result["participante"];
            
            $cursoAssociados[$i] = $cursoAssociado;
            $i++;
        }
        
        return $cursoAssociados;
    }   
    
    public function obterParticipanteAssociado($curso) {
        $participantes = array();
                
        $sql = "select t.participante from tb_curso_associado t where t.curso = %s and t.semestre = %s";
        
        $qr = $this->conn->execSQL(sprintf($sql, $curso, $_SESSION['usuario_semestre']));
        
        $i = 0;

        while ($result = $this->conn->listQr($qr)) {    
            
            if(intval($result["participante"]) <= 0){
                continue;
            }
            
            $participantes[$i] = $this->getParticipante($result["participante"]);
            $i++;
        }
        
        return $participantes;
    }
    
    public function getParticipantePorCpfCnpj($cpf_cnpj){
        
       $participante = new Participante();

        $sql = "select t.id, t.nome, t.cpf_cnpj, t.data_nasc, t.sexo, t.endereco, t.numero, t.bairro, t.cep, 
                t.cidade, lcid.nome cidadeTexto, t.estado, le.sigla estadoSigla, le.nome estadoTexto, 
                t.complemento, t.telefone, t.celular1, t.celular2, t.celular3, t.email1, t.email2,
                t.nome_mae_responsavel, t.nome_pai_responsavel, t.estado_civil,t.nome_conjuge, 
                t.profissao, t.instituicao_nome, t.instituicao_endereco, t.instituicao_numero, 
                t.instituicao_bairro, t.instituicao_cep, t.instituicao_cidade, lcidi.nome instituicao_cidadeTexto, 
                t.instituicao_estado, lei.nome instituicao_estadoTexto, t.info_sacramento, t.setor, 
                t.veiculo, t.observacoes, lc.texto funcao, t.detentor from tb_participante t 
                left join tb_curso_associado cs on (cs.participante = t.id) 
                left join lv_curso_funcao lc on (cs.funcao = lc.id)
                left join lv_cidade lcid on (lcid.id = t.cidade)                
                left join lv_estado le on (le.id = t.estado) 
                left join lv_cidade lcidi on (lcidi.id = t.cidade)
                left join lv_estado lei on (lei.id = t.estado) where t.cpf_cnpj = '%s'";

        $qr = $this->conn->execSQL(sprintf($sql, $cpf_cnpj));

        while ($result = $this->conn->listQr($qr)) {
            $participante->setId($result["id"]);
            $participante->setNome($result["nome"]);
            $participante->setCpfCnpj($result["cpf_cnpj"]);
            $participante->setDataNasc($result["data_nasc"]);
            $participante->setSexo($result["sexo"]);
            $participante->setEndereco($result["endereco"]);
            $participante->setNumero($result["numero"]);
            $participante->setBairro($result["bairro"]);
            $participante->setCep($result["cep"]);
            $participante->setCidade($result["cidade"]);
            $participante->setCidadeTexto(ucwords(strtolower($result["cidadeTexto"])));
            $participante->setEstado($result["estado"]);
            $participante->setEstadoSigla($result["estadoSigla"]);
            $participante->setEstadoTexto(ucwords(strtolower($result["estadoTexto"])));
            $participante->setComplemento($result["complemento"]);
            $participante->setTelefone($result["telefone"]);
            $participante->setCelular1($result["celular1"]);
            $participante->setCelular2($result["celular2"]);
            $participante->setCelular3($result["celular3"]);
            $participante->setEmail1($result["email1"]);
            $participante->setEmail2($result["email2"]);
            $participante->setNomeMae($result["nome_mae_responsavel"]);
            $participante->setNomePai($result["nome_pai_responsavel"]);
            $participante->setEstadoCivil($result["estado_civil"]);
            $participante->setNomeConjugue($result["nome_conjuge"]);
            $participante->setProfissao($result["profissao"]);
            $participante->setInstituicaoNome($result["instituicao_nome"]);
            $participante->setInstituicaoEndereco($result["instituicao_endereco"]);
            $participante->setInstituicaoNumero($result["instituicao_numero"]);
            $participante->setInstituicaoBairro($result["instituicao_bairro"]);
            $participante->setInstituicaoCep($result["instituicao_cep"]);
            $participante->setInstituicaoCidade($result["instituicao_cidade"]);
            $participante->setInstituicaoCidadeTexto(ucwords(strtolower($result["instituicao_cidadeTexto"])));
            $participante->setInstituicaoEstado($result["instituicao_estado"]);
            $participante->setInstituicaoEstadoTexto(ucwords(strtolower($result["instituicao_estadoTexto"])));
            $participante->setInfoSacramento($result["info_sacramento"]);
            $participante->setSetor($result["setor"]);
            $participante->setVeiculo($result["veiculo"]);
            $participante->setObservacoes($result["observacoes"]);
            $participante->setFuncaoMissao($result["funcao"]);
            $participante->setDetentor($result["detentor"]);            
        }

        return $participante;
        
    }

    public function getParticipante($id) {

        $participante = new Participante();

        $sql = 'select t.nome, t.cpf_cnpj, t.data_nasc, t.sexo, t.endereco, t.numero, t.bairro, t.cep, 
                t.cidade, lcid.nome cidadeTexto, t.estado, le.sigla estadoSigla, le.nome estadoTexto, 
                t.complemento, t.telefone, t.celular1, t.celular2, t.celular3, t.email1, t.email2,
                t.nome_mae_responsavel, t.nome_pai_responsavel, t.estado_civil,t.nome_conjuge, 
                t.profissao, t.instituicao_nome, t.instituicao_endereco, t.instituicao_numero, 
                t.instituicao_bairro, t.instituicao_cep, t.instituicao_cidade, lcidi.nome instituicao_cidadeTexto, 
                t.instituicao_estado, lei.nome instituicao_estadoTexto, t.info_sacramento, t.setor, 
                t.veiculo, t.observacoes, lc.texto funcao, t.detentor from tb_participante t 
                left join tb_curso_associado cs on (cs.participante = t.id) 
                left join lv_curso_funcao lc on (cs.funcao = lc.id)
                left join lv_cidade lcid on (lcid.id = t.cidade)                
                left join lv_estado le on (le.id = t.estado) 
                left join lv_cidade lcidi on (lcidi.id = t.cidade)
                left join lv_estado lei on (lei.id = t.estado) where t.id = %s
                and t.id in (select participante from tb_participante_semestre where semestre = %s)';

        $qr = $this->conn->execSQL(sprintf($sql, $id, $_SESSION['usuario_semestre']));

        while ($result = $this->conn->listQr($qr)) {
            $participante->setId($id);
            $participante->setNome($result["nome"]);
            $participante->setCpfCnpj($result["cpf_cnpj"]);
            $participante->setDataNasc($result["data_nasc"]);
            $participante->setSexo($result["sexo"]);
            $participante->setEndereco($result["endereco"]);
            $participante->setNumero($result["numero"]);
            $participante->setBairro($result["bairro"]);
            $participante->setCep($result["cep"]);
            $participante->setCidade($result["cidade"]);
            $participante->setCidadeTexto(ucwords(strtolower($result["cidadeTexto"])));
            $participante->setEstado($result["estado"]);
            $participante->setEstadoSigla($result["estadoSigla"]);
            $participante->setEstadoTexto(ucwords(strtolower($result["estadoTexto"])));
            $participante->setComplemento($result["complemento"]);
            $participante->setTelefone($result["telefone"]);
            $participante->setCelular1($result["celular1"]);
            $participante->setCelular2($result["celular2"]);
            $participante->setCelular3($result["celular3"]);
            $participante->setEmail1($result["email1"]);
            $participante->setEmail2($result["email2"]);
            $participante->setNomeMae($result["nome_mae_responsavel"]);
            $participante->setNomePai($result["nome_pai_responsavel"]);
            $participante->setEstadoCivil($result["estado_civil"]);
            $participante->setNomeConjugue($result["nome_conjuge"]);
            $participante->setProfissao($result["profissao"]);
            $participante->setInstituicaoNome($result["instituicao_nome"]);
            $participante->setInstituicaoEndereco($result["instituicao_endereco"]);
            $participante->setInstituicaoNumero($result["instituicao_numero"]);
            $participante->setInstituicaoBairro($result["instituicao_bairro"]);
            $participante->setInstituicaoCep($result["instituicao_cep"]);
            $participante->setInstituicaoCidade($result["instituicao_cidade"]);
            $participante->setInstituicaoCidadeTexto(ucwords(strtolower($result["instituicao_cidadeTexto"])));
            $participante->setInstituicaoEstado($result["instituicao_estado"]);
            $participante->setInstituicaoEstadoTexto(ucwords(strtolower($result["instituicao_estadoTexto"])));
            $participante->setInfoSacramento($result["info_sacramento"]);
            $participante->setSetor($result["setor"]);
            $participante->setVeiculo($result["veiculo"]);
            $participante->setObservacoes($result["observacoes"]);
            $participante->setFuncaoMissao($result["funcao"]);
            $participante->setDetentor($result["detentor"]);            
        }

        return $participante;
    }

    public function getList($where) {
        $participantes = array();

        $sql = 'select t.id, t.nome, t.cpf_cnpj, t.data_nasc, t.sexo, t.endereco, t.numero, t.bairro, t.cep, 
                t.cidade, lc.nome cidadeTexto, t.estado, le.sigla estadoSigla, le.nome estadoTexto, 
                t.complemento, t.telefone, t.celular1, t.celular2, t.celular3, t.email1, t.email2, 
                t.nome_mae_responsavel, t.nome_pai_responsavel, t.estado_civil, t.nome_conjuge, t.profissao, 
                t.instituicao_nome, t.instituicao_endereco, t.instituicao_numero, t.instituicao_bairro, 
                t.instituicao_cep, t.instituicao_cidade, t.instituicao_estado, t.info_sacramento, t.setor,
                t.veiculo, t.observacoes, lcf.texto funcao, t.detentor from tb_participante t left 
                join lv_cidade lc on (lc.id = t.cidade)
                left join lv_estado le on (le.id = t.estado) 
                left join tb_curso_associado cs on (cs.participante = t.id and cs.semestre = %s)               
                left join lv_curso_funcao lcf on (cs.funcao = lcf.id) %s and t.id in 
                (select participante from tb_participante_semestre where semestre = %s)';

        $qr = $this->conn->execSQL(sprintf($sql, $_SESSION["usuario_semestre"], $where, $_SESSION["usuario_semestre"]));

        $i = 0;

        while ($result = $this->conn->listQr($qr)) {
            $participante = new Participante();
            $participante->setId($result["id"]);
            $participante->setNome($result["nome"]);
            $participante->setCpfCnpj($result["cpf_cnpj"]);
            $participante->setDataNasc($result["data_nasc"]);
            $participante->setSexo($result["sexo"]);
            $participante->setEndereco($result["endereco"]);
            $participante->setNumero($result["numero"]);
            $participante->setBairro($result["bairro"]);
            $participante->setCep($result["cep"]);
            $participante->setCidade($result["cidade"]);
            $participante->setCidadeTexto(ucwords(strtolower($result["cidadeTexto"])));
            $participante->setEstado($result["estado"]);
            $participante->setEstadoSigla($result["estadoSigla"]);
            $participante->setEstadoTexto(ucwords(strtolower($result["estadoTexto"])));
            $participante->setComplemento($result["complemento"]);
            $participante->setTelefone($result["telefone"]);
            $participante->setCelular1($result["celular1"]);
            $participante->setCelular2($result["celular2"]);
            $participante->setCelular3($result["celular3"]);
            $participante->setEmail1($result["email1"]);
            $participante->setEmail2($result["email2"]);
            $participante->setNomeMae($result["nome_mae_responsavel"]);
            $participante->setNomePai($result["nome_pai_responsavel"]);
            $participante->setEstadoCivil($result["estado_civil"]);
            $participante->setNomeConjugue($result["nome_conjuge"]);
            $participante->setProfissao($result["profissao"]);
            $participante->setInstituicaoNome($result["instituicao_nome"]);
            $participante->setInstituicaoEndereco($result["instituicao_endereco"]);
            $participante->setInstituicaoNumero($result["instituicao_numero"]);
            $participante->setInstituicaoBairro($result["instituicao_bairro"]);
            $participante->setInstituicaoCep($result["instituicao_cep"]);
            $participante->setInstituicaoCidade($result["instituicao_cidade"]);
            $participante->setInstituicaoEstado($result["instituicao_estado"]);
            $participante->setInfoSacramento($result["info_sacramento"]);
            $participante->setVeiculo($result["veiculo"]);
            $participante->setFuncaoMissao($result["funcao"]);
            $participante->setObservacoes($result["observacoes"]);
            $participante->setDetentor($result["detentor"]);   

            $participantes[$i] = $participante;
            $i++;
        }

        return $participantes;
    }

    public function Delete($id) {

        $sql = 'delete from tb_participante where id = %s';
        $result = $this->conn->execSQL(sprintf($sql, $id));

        return $result;
    }

    public function Count($where) {

        $sql = 'select count(*) qtd from tb_participante %s';
        $qr = $this->conn->execSQL(sprintf($sql, $where));
        $result = $this->conn->listQr($qr);

        return $result["qtd"];
    }
    
    public function ObterInformacaoSacramento($valor){
        $strRetorno = '';
        $sql = 'select texto, valor from lv_info_sacramento';
        $qr = $this->conn->execSQL($sql);
        
        while ($result = $this->conn->listQr($qr)) {            
            if(((intval($result["valor"])) & (intval($valor))) > 0){
                $strRetorno .= $result["texto"].'; ';
            }                  
        }
        
        return $strRetorno;
    }
    
    public function ObterVeiculos($valor){
        $strRetorno = '';
        $sql = 'select texto, valor from lv_veiculo';
        $qr = $this->conn->execSQL($sql);
        
        while ($result = $this->conn->listQr($qr)) {            
            if(((intval($result["valor"])) & (intval($valor))) > 0){
                $strRetorno .= $result["texto"].'; ';
            }                  
        }
        
        return $strRetorno;
    }
    
     public function ObterSetores($valor){
        $strRetorno = '';
        $sql = 'select texto, valor from lv_setor';
        $qr = $this->conn->execSQL($sql);
        
        while ($result = $this->conn->listQr($qr)) {            
            if(((intval($result["valor"])) & (intval($valor))) > 0){
                $strRetorno .= $result["texto"].'; ';
            }                  
        }
        
        return $strRetorno;
    }
}

?>
