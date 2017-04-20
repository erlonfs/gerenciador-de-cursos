<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mensagem
 *
 * @author Erlon
 */
class Mensagem {

    //put your code here

    private function __construct() {
        
    }

    public static function Add($mensagem, $tipo) {
        $mensagens = array();

        if (!empty($_SESSION['mensagens'])) {
            $mensagens = $_SESSION['mensagens'];
        }

        $mensagens[sizeof($mensagens)] = array("tipo" => $tipo, "mensagem" => $mensagem);

        $_SESSION['mensagens'] = $mensagens;
    }

    public static function ObterMensagens() {

        if (!empty($_SESSION['mensagens'])) {

            $mensagens = $_SESSION['mensagens'];

            unset($_SESSION['mensagens']);

            return $mensagens;
        }
    }

    public static function ObterClasseCss($tipo) {

        switch ($tipo) {
            case 1:
                return "sucessoMsg";
            case 2:
                return "alertMsg";
            case 3:
                return "erroMsg";
        }
    }

}

?>
