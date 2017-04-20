<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManipulaDados
 *
 * @author Erlon
 */
class ManipulaDados {

    
    public function __construct() {
        
    }
    
    //put your code here
    public function converteData($data, $tipoRetorno) {
        switch ($tipoRetorno) {
            //caso 1: retorna data tipo Brasil em string dia de mes de ano. ex: 01 de janeiro de 0000
            case 1:
                $dataAux = explode("/", $data);
                $dia = $dataAux[0];
                $mes = $dataAux[1];
                $ano = $dataAux[2];
                if ($mes == "01" || $mes == "1") {
                    $mes = "janeiro";
                } else if ($mes == "02" || $mes == "2") {
                    $mes = "fevereiro";
                } else if ($mes == "03" || $mes == "3") {
                    $mes = "março";
                } else if ($mes == "04" || $mes == "4") {
                    $mes = "abril";
                } else if ($mes == "05" || $mes == "5") {
                    $mes = "maio";
                } else if ($mes == "06" || $mes == "6") {
                    $mes = "junho";
                } else if ($mes == "07" || $mes == "7") {
                    $mes = "julho";
                } else if ($mes == "08" || $mes == "8") {
                    $mes = "agosto";
                } else if ($mes == "09" || $mes == "9") {
                    $mes = "setembro";
                } else if ($mes == "10") {
                    $mes = "outubro";
                } else if ($mes == "11") {
                    $mes = "novembro";
                } else if ($mes == "12") {
                    $mes = "dezembro";
                }
                $dataConvertida .= "$dia de $mes  de $ano";
                return $dataConvertida;
                break;
            //caso 2: retorna data do tipo MySql para tipo Brasil ex: de 0000-00-00 para 00/00/0000
            case 2:
                $dataAux = explode("-", $data);
                $dia = $dataAux[2];
                $mes = $dataAux[1];
                $ano = $dataAux[0];
                $dataConvertida = "$dia/$mes/$ano";
                return $dataConvertida;
                break;

            //caso 3: retorna data do tipo Brasil para o Tipo MySql. ex: de 00/00/0000 para 0000-00-00
            case 3:
                $dataAux = explode("/", $data);
                $dia = $dataAux[0];
                $mes = $dataAux[1];
                $ano = $dataAux[2];
                $dataConvertida = "$ano-$mes-$dia";
                return $dataConvertida;
                break;

            //caso 4: retorna data do tipo MySql para dia de mes de ano. ex: 01 de janeiro de 0000
            case 4:
                $dataAux = self::converteData($data, 2);
                $dataConvertida = self::converteData($dataAux, 1);
                return $dataConvertida;
                break;
        }
    }

}
?>
