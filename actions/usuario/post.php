<?php

session_start();

include_once '../../entities/Usuario.php';
include_once '../../data/UsuarioDAO.php';
include_once '../../classes/Conexao.php';
include_once '../../classes/Mensagem.php';
include_once '../../classes/Config.php';

$usuario = new Usuario();

$usuario->setId(addslashes($_POST['id']));
$usuario->setNome(addslashes($_POST['nome']));
$usuario->setDataNasc(addslashes($_POST['data_nasc']));
$usuario->setSexo(addslashes($_POST['sexo']));
$usuario->setEndereco(addslashes($_POST['endereco']));
$usuario->setNumero(addslashes($_POST['numero']));
$usuario->setBairro(addslashes($_POST['bairro']));
$usuario->setCep(addslashes($_POST['cep']));
$usuario->setCidade(addslashes($_POST['cidade']));
$usuario->setEstado(addslashes($_POST['estado']));
$usuario->setComplemento(addslashes($_POST['complemento']));
$usuario->setTelefone(addslashes($_POST['telefone']));
$usuario->setCelular1(addslashes($_POST['celular1']));
$usuario->setCelular2(addslashes($_POST['celular2']));
$usuario->setCelular3(addslashes($_POST['celular3']));
$usuario->setEmail1(addslashes($_POST['email1']));
$usuario->setEmail2(addslashes($_POST['email2']));
$usuario->setLogin(addslashes($_POST['login']));
$usuario->setSenha(addslashes($_POST['senha']));
$usuario->setTipo(2/*Tipo Usuario 2*/);


$dataAcess = new UsuarioDAO();
$dataAcess->Salvar($usuario);       
?>

