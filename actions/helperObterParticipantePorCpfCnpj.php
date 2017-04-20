<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../data/ParticipanteDAO.php';
include_once '../entities/Participante.php';
include_once '../classes/Conexao.php';

if(isset($_POST['CpjCnpj'])){
    $participanteDa = new ParticipanteDAO();
    $participante = $participanteDa->getParticipantePorCpfCnpj($_POST['CpjCnpj']);
    
    echo "{\"Id\": ".$participante->getId()."}";
}
?>


