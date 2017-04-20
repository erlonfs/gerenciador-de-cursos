<pre>
<?php

session_start();

include_once '../../entities/Participante.php';
include_once '../../data/ParticipanteDAO.php';
include_once '../../classes/Conexao.php';
include_once '../../classes/Config.php';
include_once '../../entities/CursoAssociado.php';

$aux = $_POST['cursos'];
$cursosAssociados = array();

$pos = 0;



for($i = 0; $i <sizeof($aux); $i++){
    $curso = new CursoAssociado();
    $curso->id = $aux[$i]['id'];
    $curso->funcao = $aux[$i]['funcao'];
    $curso->funcaoTexto = '';
    $curso->participante = $aux[$i]['participante'];
    $curso->curso = $aux[$i]['curso'];
    $curso->cursoTexto = '';   
    
    $cursosAssociados[$pos] = $curso;
    $pos++;
}

$dataAcessObject = new ParticipanteDAO();
$dataAcessObject->associar($cursosAssociados);   

var_dump($cursosAssociados);




?>
</pre>
