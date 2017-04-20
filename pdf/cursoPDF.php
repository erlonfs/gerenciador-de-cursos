<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

include_once '../classes/Conexao.php';
include_once '../classes/Config.php';

include_once '../entities/Curso.php';

include_once '../data/CursoDAO.php';
include_once '../data/HelperDAO.php';

include_once '../lib/dompdf/dompdf_config.inc.php';


$dataAcessObject = new CursoDAO();

$curso = $dataAcessObject->getCurso($_GET['id']);

$templatePDF = '<html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <style>
                    body{font-family: "Trebuchet MS"; font-size: 12px}
                    h1 {color:#333; size:14px; margin-bottom:5px;}
                    h3 {color:#222;}
                    span{font-size: 12px; font-weight: bold}
                    hr{border-color: #ccc}
                    .rodape{margin: 540px 0 0 0; font-size: 8px}
                </style>
                <body>

                <h1>' . $curso->getNomeLocal() . '</h1>
                <hr/>        

                <table border="0px" width="100%" heigth="600px">           
                    <tr>
                        <td><span>Cidade:</span></td>
                        <td>' . $curso->getCidadeNome() . '</td>
                    </tr>
                    <tr>
                        <td><span>Estado:</span></td>
                        <td>' . $curso->getEstadoNome() . '</td>
                    </tr>
                    <tr>
                        <td><span>Endereco:</span></td>
                        <td>' . $curso->getEndereco() . '</td>
                    </tr>
                    <tr>
                        <td><span>Bairro:</span></td>
                        <td>' . $curso->getBairro() . '</td>
                    </tr>
                    <tr>
                        <td><span>Numero:</span></td>
                        <td>' . $curso->getNumero() . '</td>
                    </tr>
                    <tr>
                        <td><span>CEP:</span></td>
                        <td>' . $curso->getCep() . '</td>
                    </tr>
                </table>
                
                <div class="rodape">Copyright 2012 | Enchei-vos - Todos os Direitos Reservados</div>
                <hr/>
            </body>
         </html>';


$dompdf = new DOMPDF();
$dompdf->load_html($templatePDF);
$dompdf->set_paper('letter');
$dompdf->render();
$dompdf->stream("CursoPDF.pdf");
?>


