<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDAO
 *
 * @author Erlon
 */
class UsuarioDAO {
    private $conn;    
    
    public function __construct() {
        $this->conn = new Conexao();
    }
    
    public function Salvar(Usuario $usuario){
        if($usuario->getId() > 0){
            $this->Update($usuario);
        }else{
            $this->Insert($usuario);
        }
    }

    private function Insert(Usuario $usuario){
                
        $sql = "insert into tb_usuario (nome, data_nasc, sexo, endereco, 
               numero, bairro, cep, cidade, estado, complemento, telefone, celular1, 
               celular2, celular3, email1, email2, login, senha, semestre, tipo) 
               values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, %s, '%s', '%s', 
               '%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, %s)";
        
        $result = $this->conn->execSQL(sprintf($sql, 
               $usuario->getNome(),
               $usuario->getDataNasc(),
               $usuario->getSexo(),
               $usuario->getEndereco(),
               $usuario->getNumero(),
               $usuario->getBairro(),
               $usuario->getCep(),
               $usuario->getCidade(),
               $usuario->getEstado(),
               $usuario->getComplemento(),
               $usuario->getTelefone(),
               $usuario->getCelular1(),
               $usuario->getCelular2(),
               $usuario->getCelular3(),
               $usuario->getEmail1(),
               $usuario->getEmail2(),
               $usuario->getLogin(),
               $usuario->getSenha(),
               $usuario->getSemestre(),
               $usuario->getTipo()));
        
        
        return $result;
    }
    
    private function Update(Usuario $usuario){
        
        
        $sql = "update tb_usuario t set t.nome = '%s', t.data_nasc = '%s', t.sexo = '%s', t.endereco = '%s', 
               t.numero = '%s', t.bairro = '%s', t.cep = '%s', t.cidade = %s, t.estado = %s, t.complemento = '%s', 
               t.telefone = '%s', t.celular1 = '%s', t.celular2 = '%s', t.celular3 = '%s', t.email1 = '%s', 
               t.email2 = '%s', t.login = '%s', t.senha = '%s', t.semestre = %s, t.tipo = %s where t.id = %s";
        
        $result = $this->conn->execSQL(sprintf($sql, 
               $usuario->getNome(),
               $usuario->getDataNasc(),
               $usuario->getSexo(),
               $usuario->getEndereco(),
               $usuario->getNumero(),
               $usuario->getBairro(),
               $usuario->getCep(),
               $usuario->getCidade(),
               $usuario->getEstado(),
               $usuario->getComplemento(),
               $usuario->getTelefone(),
               $usuario->getCelular1(),
               $usuario->getCelular2(),
               $usuario->getCelular3(),
               $usuario->getEmail1(),
               $usuario->getEmail2(),
               $usuario->getLogin(),
               $usuario->getSenha(),
               $usuario->getSemestre(),
               $usuario->getTipo(),
               $usuario->getId()));        
        
        return $result;
    }
    
    public function associar($cursosAssociado) {      
        
        $sql = "delete from tb_curso_associado where usuario = %s";

        $this->conn->execSQL(sprintf($sql, $cursosAssociado[0]->usuario));

        
        for($i = 0; $i < sizeof($cursosAssociado); $i++){
                $sql = "insert into tb_curso_associado (usuario, curso, funcao) values(%s, %s, %s, %s)";
                
                $this->conn->execSQL(sprintf($sql,
                       $cursosAssociado[$i]->usuario,
                       $cursosAssociado[$i]->curso,
                       $cursosAssociado[$i]->funcao,
                       $_SESSION['usuario_semestre']));                
        }
    }
    
    public function obterCursoAssociado($participante) {
        $cursoAssociados = array();
                
        $sql = "select t.id, t.usuario, t.curso, c.nome_local curso_texto, t.funcao, 
                lc.texto funcao_texto from tb_curso_associado t, tb_curso c, lv_curso_funcao lc 
                where t.usuario = %s and c.id = t.curso and lc.id = t.funcao and t.semestre = %s";
        
        $qr = $this->conn->execSQL(sprintf($sql, $participante, $_SESSION['usuario_semestre']));
        
        $i = 0;

        while ($result = $this->conn->listQr($qr)) {
            $cursoAssociado = new CursoAssociado();
            $cursoAssociado->id = $result["id"];
            $cursoAssociado->curso = $result["curso"];
            $cursoAssociado->cursoTexto = $result["curso_texto"];
            $cursoAssociado->funcao = $result["funcao"];
            $cursoAssociado->funcaoTexto = $result["funcao_texto"];
            $cursoAssociado->usuario = $result["usuario"];
            
            $cursoAssociados[$i] = $cursoAssociado;
            $i++;
        }
        
        return $cursoAssociados;
    }        
    
    public function obterUsuarioAssociado($curso) {
        $usuarios = array();
                
        $sql = "select t.usuario from tb_curso_associado t where t.curso = %s and t.semestre = %s";
        
        $qr = $this->conn->execSQL(sprintf($sql, $curso, $_SESSION['usuario_semestre']));
        
        $i = 0;

        while ($result = $this->conn->listQr($qr)) { 
            
            if(intval($result["usuario"]) <= 0){
                continue;
            }
            
            $usuarios[$i] = $this->getUsuario($result["usuario"]);
            $i++;
        }
        
        return $usuarios;
    }
    
    public function getUsuario($id){
        
        $usuario = new Usuario();
        
        $sql = 'select t.id, t.nome, t.data_nasc, t.sexo, t.endereco, t.numero, t.bairro, t.cep, 
                t.cidade, t.estado, t.complemento, t.telefone, t.celular1, t.celular2, t.celular3,
                t.email1, t.email2, t.login, t.senha, t.semestre, t.tipo, lc.texto funcao from tb_usuario t 
                left join tb_curso_associado cs on (cs.usuario = t.id) left join lv_curso_funcao lc 
                on (cs.funcao = lc.id) where t.id = %s';
        
        $qr = $this->conn->execSQL(sprintf($sql, $id));        
        
        while ($result = $this->conn->listQr($qr)){            
            $usuario->setId($id);
            $usuario->setNome($result["nome"]);
            $usuario->setDataNasc($result["data_nasc"]);
            $usuario->setSexo($result["sexo"]);
            $usuario->setEndereco($result["endereco"]);
            $usuario->setNumero($result["numero"]);
            $usuario->setBairro($result["bairro"]);
            $usuario->setCep($result["cep"]);
            $usuario->setCidade($result["cidade"]);
            $usuario->setEstado($result["estado"]);
            $usuario->setComplemento($result["complemento"]);
            $usuario->setTelefone($result["telefone"]);
            $usuario->setCelular1($result["celular1"]);
            $usuario->setCelular2($result["celular2"]);
            $usuario->setCelular3($result["celular3"]);
            $usuario->setEmail1($result["email1"]);
            $usuario->setEmail2($result["email2"]);
            $usuario->setFuncaoMissao($result["funcao"]);
            $usuario->setLogin($result["login"]);
            $usuario->setSenha($result["senha"]);
            $usuario->setSemestre($result["semestre"]);
            $usuario->setTipo($result["tipo"]);                                                                   
        }      
        
        return $usuario;  
    }
        
    public function getList($where){        
        $usuarios = array();
        
        $sql = 'select t.id, t.nome, t.data_nasc, t.sexo, t.endereco, t.numero, t.bairro, t.cep, 
                t.cidade, t.estado, t.complemento, t.telefone, t.celular1, t.celular2, t.celular3, 
                t.email1, t.email2, t.login, t.senha, t.semestre, t.tipo, lc.texto funcao from tb_usuario t
                left join tb_curso_associado cs on (cs.usuario = t.id) left join lv_curso_funcao lc 
                on (cs.funcao = lc.id) %s';
        
        $qr = $this->conn->execSQL(sprintf($sql, $where));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $usuario = new Usuario();
            $usuario->setId($result["id"]);
            $usuario->setNome($result["nome"]);
            $usuario->setDataNasc($result["data_nasc"]);
            $usuario->setSexo($result["sexo"]);
            $usuario->setEndereco($result["endereco"]);
            $usuario->setNumero($result["numero"]);
            $usuario->setBairro($result["bairro"]);
            $usuario->setCep($result["cep"]);
            $usuario->setCidade($result["cidade"]);
            $usuario->setEstado($result["estado"]);
            $usuario->setComplemento($result["complemento"]);
            $usuario->setTelefone($result["telefone"]);
            $usuario->setCelular1($result["celular1"]);
            $usuario->setCelular2($result["celular2"]);
            $usuario->setCelular3($result["celular3"]);
            $usuario->setEmail1($result["email1"]);
            $usuario->setEmail2($result["email2"]);
            $usuario->setFuncaoMissao($result["funcao"]);
            $usuario->setLogin($result["login"]);
            $usuario->setSenha($result["senha"]);
            $usuario->setSemestre($result["semestre"]);
            $usuario->setTipo($result["tipo"]);                     
            
            $usuarios[$i] = $usuario;  
            $i++;
        }
        
        return $usuarios;
    }
    
    public function Delete($id){        
        $sql = 'delete from tb_usuario where id = %s';        
        $result = $this->conn->execSQL(sprintf($sql, $id));
        
        return $result;
    }
    
    public function Count($where){        
        $sql = 'select count(*) qtd from tb_usuario %s';        
        
        $qr = $this->conn->execSQL(sprintf($sql, $where));
        
        $result = $this->conn->listQr($qr);
                      
        return $result["qtd"];     
    }
}

?>
