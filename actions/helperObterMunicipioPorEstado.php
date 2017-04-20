<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../data/HelperDAO.php';
include_once '../classes/Helper.php';
include_once '../entities/Estado.php';
include_once '../entities/Cidade.php';
include_once '../classes/Conexao.php';

if(isset($_GET['estado'])){
    $helper = new Helper();
    $helperDa = new HelperDAO();
    $municipios = $helperDa->ObterMunicipiosJSONEncode($_GET['estado']);
        
    echo json_encode($helper->objectToArray($municipios));
    
}
?>


