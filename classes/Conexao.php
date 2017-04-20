<?php

//header("Content-Type: text/html; charset=ISO-8859-1",true);
//header("Content-Type: text/html; charset=utf-8",true);

//arquivo de conexao com o mysql
class Conexao {

    //variaveis
    private $user;
    private $senha;
    private $host;
    private $banco;
    private $qr;
    private $data;
    private $linkConexao;
    private $totalFields;

    //construtor
    public function __construct() {
        $this->user = "root";
        $this->senha = "";
        $this->host = "localhost";
        $this->banco = "db_encheivos";
        self::connect();
        mysql_query("SET NAMES utf-8", $this->linkConexao);
    }

    //destrutor do obj
    public function __destruct() {
        if ($this->linkConexao) {
            @mysql_close($this->linkConexao);
        } else {
            print ('Erro ao Fechar link de Conexao' . mysql_error());
        }
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setBanco($banco) {
        $this->banco = $banco;
    }

    public function connect() {
        $this->linkConexao = mysql_connect($this->host, $this->user, $this->senha) or die("<center><h1>Erro ao conectar com o Mysql " . mysql_error() . "</center></h1>");
        $banco = mysql_select_db($this->banco) or die("<h1><center>Erro ao selecionar banco: " . mysql_error() . "</center></h1>");
    }

    public function execSQL($sql) {        
        $this->qr = @mysql_query($sql) or die("<b><center>Erro ao Executar o Query: $sql - </b></center><br />" . mysql_error());
        return $this->qr;
    }

    public function listQr($qr) {
        $this->data = @mysql_fetch_assoc($qr);
        return $this->data;
    }

    protected function countData($qr) {
        $this->totalFields = mysql_num_rows($qr);
        return $this->totalFields;
    }

}

?>
