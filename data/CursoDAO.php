<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CursoDAO
 *
 * @author Erlon
 */
class CursoDAO {
    private $conn;    
    
    public function __construct() {
        $this->conn = new Conexao();
    }
    
    public function Salvar(Curso $curso){
        if($curso->getId() > 0){
            $this->Update($curso);
        }else{
            $this->Insert($curso);
        }
    }

    private function Insert(Curso $curso){
                        
        $sql = "insert into tb_curso (nome_local, endereco, numero, bairro, cep, 
                cidade, estado, detentor) values ('%s', '%s', '%s', '%s', '%s', '%s', %s, %s)";
        
        $result = $this->conn->execSQL(sprintf($sql, 
               $curso->getNomeLocal(),
               $curso->getEndereco(),
               $curso->getNumero(),
               $curso->getBairro(),
               $curso->getCep(),
               $curso->getCidade(),
               $curso->getEstado(),
               $curso->getDetentor()));
        
        
        return $result;
    }
    
    private function Update(Curso $curso){
        
        
        $sql = "update tb_curso t set t.nome_local = '%s', t.endereco = '%s', 
               t.numero = '%s', t.bairro = '%s', t.cep = '%s', t.cidade = '%s', 
               t.estado = %s, t.detentor = %s where t.id = %s";
        
        $result = $this->conn->execSQL(sprintf($sql, 
               $curso->getNomeLocal(),
               $curso->getEndereco(),
               $curso->getNumero(),
               $curso->getBairro(),
               $curso->getCep(),
               $curso->getCidade(),
               $curso->getEstado(),
               $curso->getDetentor(),
               $curso->getId()));        
        
        return $result;
    }
    
    public function getCurso($id){
        
        $curso = new Curso();
        
        $sql = 'select t.id, t.nome_local, t.endereco, t.numero, t.bairro, t.cep, t.cidade, 
                e.id estado, e.nome estado_nome, c.id cidade, c.nome cidade_nome, 
                t.detentor from tb_curso t, lv_estado e, lv_cidade c where t.id = %s and e.id = t.estado
                and c.id = t.cidade';
        
        $qr = $this->conn->execSQL(sprintf($sql, $id));        
        
        while ($result = $this->conn->listQr($qr)){            
            $curso->setId($id);
            $curso->setNomeLocal($result["nome_local"]);
            $curso->setEndereco($result["endereco"]);
            $curso->setNumero($result["numero"]);
            $curso->setBairro($result["bairro"]);
            $curso->setCep($result["cep"]);
            $curso->setCidade($result["cidade"]);
            $curso->setCidadeNome(ucwords(strtolower($result["cidade_nome"])));
            $curso->setEstado($result["estado"]);
            $curso->setEstadoNome($result["estado_nome"]);
            $curso->setDetentor($result["detentor"]);                                                                   
        }      
        
        return $curso;  
    }
        
    public function getList($where){        
        $cursos = array();
        
        $sql = 'select t.id, t.nome_local, t.endereco, t.numero, t.bairro, t.cep, t.cidade, 
                e.id estado, e.nome estado_nome, c.id cidade, c.nome cidade_nome, 
                t.detentor from tb_curso t, lv_estado e, lv_cidade c %s and e.id = t.estado
                and c.id = t.cidade';
        
        $qr = $this->conn->execSQL(sprintf($sql, $where));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $curso = new Curso();
            $curso->setId($result["id"]);
            $curso->setNomeLocal($result["nome_local"]);
            $curso->setEndereco($result["endereco"]);
            $curso->setNumero($result["numero"]);
            $curso->setBairro($result["bairro"]);
            $curso->setCep($result["cep"]);
            $curso->setCidade($result["cidade"]);
            $curso->setCidadeNome(ucwords(strtolower($result["cidade_nome"])));
            $curso->setEstado($result["estado"]);
            $curso->setEstadoNome($result["estado_nome"]);
            $curso->setDetentor($result["detentor"]);
            
            $cursos[$i] = $curso;  
            $i++;
        }
        
        return $cursos;
    }
    
    public function Delete($id){        
        $sql = 'delete from tb_curso where id = %s';        
        $result = $this->conn->execSQL(sprintf($sql, $id));
        
        return $result;
    }
    
    public function Count($where){        
        $sql = 'select count(*) qtd from tb_curso %s';        
        
        $qr = $this->conn->execSQL(sprintf($sql, $where));
        
        $result = $this->conn->listQr($qr);
                      
        return $result["qtd"];     
    }
}

?>
