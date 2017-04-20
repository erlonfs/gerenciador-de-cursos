<pre>
<?php

include_once '../../entities/Usuario.php';
include_once '../../data/UsuarioDAO.php';
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
    $curso->usuario = $aux[$i]['usuario'];
    $curso->curso = $aux[$i]['curso'];
    $curso->cursoTexto = '';   
    
    $cursosAssociados[$pos] = $curso;
    $pos++;
}

$dataAcessObject = new UsuarioDAO();
$dataAcessObject->associar($cursosAssociados);    




?>
</pre>
