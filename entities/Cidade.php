<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidade
 *
 * @author Erlon
 */
class Cidade {
    //put your code here
    public $id;
    public $nome;
    public $estado;
    
    public function __construct() {
        $this->estado = new Estado();
    }
}

?>
