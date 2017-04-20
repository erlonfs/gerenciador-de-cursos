<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//INICIALIZA A SESSÃO 
session_start(); 

//DESTRÓI AS SESSOES
unset($_SESSION['usuario']);
unset($_SESSION['usuario_nome']);
unset($_SESSION['usuario_login']);
unset($_SESSION['usuario_senha']);
unset($_SESSION['usuario_tipo']);
unset($_SESSION['usuario_semestre']);
session_destroy(); 

@header('Location: login.php');
?>