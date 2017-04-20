<?php

session_start();

include_once '../../entities/Curso.php';
include_once '../../data/CursoDAO.php';
include_once '../../classes/Conexao.php';
include_once '../../classes/Mensagem.php';
include_once '../../classes/Config.php';

$curso = new Curso();
$curso->setId(addslashes($_POST['id']));

$curso->setNomeLocal(addslashes($_POST['nome_local']));
$curso->setEndereco(addslashes($_POST['endereco']));
$curso->setNumero(addslashes($_POST['numero']));
$curso->setBairro(addslashes($_POST['bairro']));
$curso->setCep(addslashes($_POST['cep']));
$curso->setCidade(addslashes($_POST['cidade']));
$curso->setEstado(addslashes($_POST['estado']));
$curso->setDetentor(addslashes($_SESSION['usuario']));

$dataAcess = new CursoDAO();
$dataAcess->Salvar($curso);       
?>

