<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

include_once '../data/HelperDAO.php';
include_once '../data/UsuarioDAO.php';
include_once '../classes/Helper.php';
include_once '../classes/Conexao.php';
include_once '../entities/Usuario.php';

if(isset($_POST['semestre'])){
    $helper = new Helper();
    $helperDa = new HelperDAO();
    $usuarioDa = new UsuarioDAO();
    
    $usuario = $usuarioDa->getUsuario($_SESSION['usuario']);
    $usuario->setSemestre(intval($_POST['semestre']));
    
    $usuarioDa->Salvar($usuario);
    
    $_SESSION['usuario_semestre'] = $_POST['semestre'];       
    $_SESSION['exibir_msg'] = TRUE;
}
?>


