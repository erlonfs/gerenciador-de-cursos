<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HelperDa
 *
 * @author Erlon
 */
class HelperDAO {
    //put your code here
     private $conn;    
    
    public function __construct() {
        $this->conn = new Conexao();
    }
    
    public function ObterEstado($id){
        $estado = new Estado();
        
        $sql = 'select nome, sigla from lv_estado where id = %s order by nome';        
        $qr = $this->conn->execSQL(sprintf($sql, $id));                      
        
        while ($result = $this->conn->listQr($qr)){                        
            $estado->id = $id;
            $estado->nome = $result["nome"];
            $estado->sigla = $result["sigla"];
        }
        
        return $estado;        
    }
    
    public function ObterEstados(){
        $estados = array();
        
        $sql = 'select id, nome, sigla from lv_estado order by nome';
        
        $qr = $this->conn->execSQL(sprintf($sql));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $estado = new Estado();
            $estado->id = $result["id"];
            $estado->nome = ucwords(strtolower($result["nome"]));
            $estado->sigla = $result["sigla"];
            
            $estados[$i] = $estado;  
            $i++;
        }
        
        return $estados;
        
    }       
    
    public function ObterMunicipios($estado){
        $cidades = array();
        
        $sql = 'select id, nome, estado from lv_cidade where estado = %s order by nome';
        
        $qr = $this->conn->execSQL(sprintf($sql, $estado));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $cidade = new Cidade();
            $cidade->id = $result["id"];
            $cidade->nome = $result["nome"];
            $cidade->estado = $this->ObterEstado($estado);
            
            $cidades[$i] = $cidade;  
            $i++;
        }
        
        return $cidades;
        
    }
    
    public function ObterMunicipiosJSONEncode($estado){
        $cidades = array();
        
        $sql = 'select id, nome, estado from lv_cidade where estado = %s order by nome';
        
        $qr = $this->conn->execSQL(sprintf($sql, $estado));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $cidade = new Cidade();
            $cidade->id = $result["id"];
            $cidade->nome = utf8_encode($result["nome"]);
            $cidade->estado = $this->ObterEstado($estado);
            
            $cidades[$i] = $cidade;  
            $i++;
        }
        
        return $cidades;
        
    }
    
    public function ObterInfoSacramentos(){
        $lista = array();
        
        $sql = 'select id, texto, valor from lv_info_sacramento order by id';
        
        $qr = $this->conn->execSQL(sprintf($sql));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $entidade = new Lista();
            $entidade->id = $result["id"];
            $entidade->texto = ucwords(strtolower($result["texto"]));
            $entidade->valor = $result["valor"];
            
            $lista[$i] = $entidade;  
            $i++;
        }
        
        return $lista;
        
    } 
    
    public function ObterInfoSacramentosPorCodigo($intCod){
        $lista = array();        
        $info_sacramentos = $this->ObterInfoSacramentos();        
        $posicao = 0;
        
        for($i = 0; $i < sizeof($info_sacramentos); $i++){            
            if((intval($info_sacramentos[$i]->valor) & intval($intCod)) > 0){                
                $lista[$posicao] = $info_sacramentos[$i];                
                $posicao++;                
            }                        
        }
        
        return $lista;                
        
    }
    
    public function ObterSetores(){
        $lista = array();
        
        $sql = 'select id, texto, valor from lv_setor order by id';
        
        $qr = $this->conn->execSQL(sprintf($sql));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $entidade = new Lista();
            $entidade->id = $result["id"];
            $entidade->texto = ucwords(strtolower($result["texto"]));
            $entidade->valor = $result["valor"];
            
            $lista[$i] = $entidade;  
            $i++;
        }
        
        return $lista;
        
    } 
    
    public function ObterSetoresPorCodigo($intCod){
        $lista = array();        
        $setores = $this->ObterSetores();        
        $posicao = 0;
        
        for($i = 0; $i < sizeof($setores); $i++){            
            if((intval($setores[$i]->valor) & intval($intCod)) > 0){                
                $lista[$posicao] = $setores[$i];                
                $posicao++;                
            }                        
        }
        
        return $lista;                
        
    }
    
    public function ObterVeiculos(){
        $lista = array();
        
        $sql = 'select id, texto, valor from lv_veiculo order by id';
        
        $qr = $this->conn->execSQL(sprintf($sql));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $entidade = new Lista();
            $entidade->id = $result["id"];
            $entidade->texto = ucwords(strtolower($result["texto"]));
            $entidade->valor = $result["valor"];
            
            $lista[$i] = $entidade;  
            $i++;
        }
        
        return $lista;
        
    }
    
    public function ObterVeiculosPorCodigo($intCod){
        $lista = array();        
        $veiculos = $this->ObterVeiculos();        
        $posicao = 0;
        
        for($i = 0; $i < sizeof($veiculos); $i++){            
            if((intval($veiculos[$i]->valor) & intval($intCod)) > 0){                
                $lista[$posicao] = $veiculos[$i];                
                $posicao++;                
            }                        
        }
        
        return $lista;                
        
    }
    
    public function ObterCursoFuncoes(){
        $lista = array();
        
        $sql = 'select id, texto from lv_curso_funcao order by id';
        
        $qr = $this->conn->execSQL(sprintf($sql));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $entidade = new Lista();
            $entidade->id = $result["id"];
            $entidade->texto = ucwords(strtolower($result["texto"]));
            
            $lista[$i] = $entidade;  
            $i++;
        }
        
        return $lista;
        
    }   
    
    public function ObterCursoFuncao(){
        $lista = array();
        
        $sql = 'select id, texto from lv_curso_funcao order by id';
        
        $qr = $this->conn->execSQL(sprintf($sql));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $entidade = new Lista();
            $entidade->id = $result["id"];
            $entidade->texto = ucwords(strtolower($result["texto"]));
            
            $lista[$i] = $entidade;  
            $i++;
        }
        
        return $lista;
        
    } 
    
    public function ObterLocalCurso(){
        $lista = array();
        
        $sql = 'select id, nome_local texto from tb_curso order by id';
        
        $qr = $this->conn->execSQL(sprintf($sql));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $entidade = new Lista();
            $entidade->id = $result["id"];
            $entidade->texto = ucwords(strtolower($result["texto"]));
            
            $lista[$i] = $entidade;  
            $i++;
        }
        
        return $lista;
        
    }
    
    public function ObterSemestres(){                                                 
        $lista = array();
        
        $sql = 'select id, texto from lv_semestre where id > 0 order by id asc';
        
        $qr = $this->conn->execSQL(sprintf($sql));              
        
        $i = 0;
        
        while ($result = $this->conn->listQr($qr)){            
            $entidade = new Lista();
            $entidade->id = $result["id"];
            $entidade->texto = ucwords(strtolower($result["texto"]));
            
            $lista[$i] = $entidade;  
            $i++;
        }
        
        return $lista;
    }
    
   public function ObterSemestreAtualTexto(){
        $ano = date("Y");
        $perido = date("m") > 6 ? 2 : 1;
               
        return $ano.'/'.$perido;        
    } 
    
    public function ObterSemestreAtualId(){
        $sql = "select id from lv_semestre where texto = '%s'";
        
        $qr = $this->conn->execSQL(sprintf($sql, self::ObterSemestreAtualTexto()));
        $result = $this->conn->listQr($qr);

        return $result["id"];
    } 
                       
}

?>
