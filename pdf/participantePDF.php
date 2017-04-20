<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

include_once '../classes/Conexao.php';
include_once '../classes/Config.php';
include_once '../classes/ManipulaDados.php';

include_once '../entities/Participante.php';
include_once '../entities/CursoAssociado.php';

include_once '../data/ParticipanteDAO.php';
include_once '../data/HelperDAO.php';

include_once '../lib/dompdf/dompdf_config.inc.php';


$dataAcessObject = new ParticipanteDAO();



if (!isset($_GET['id'])) {

    $participantes = $dataAcessObject->getList('where 1 = 1');                      
   

    $templatePDF = '<html>
                    <title></title>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head>
                    <body>
                    <div id="content-pdf">

    <style type="text/css">
        h1{font-size: 16px; color: #333; margin-bottom: 10px; position: relative}
        tr{
            border: 1px solid #666;
        }
        hr{color: #ccc}
        .rodape{font-size: 10px}
        
        table{font-size: 8px}
    </style>

    <h1>
        Listagem de participantes
    </h1>
    <br/>

    <table width="100%">
        <thead>
            <tr>
                <td width="9%">Nome</td>
                <td width="9%">Data nascimento</td>
                <td width="9%">Cidade/Estado</td>
                <td width="9%">Local curso</td>
                <td width="9%">Telefone/Celular</td>
                <td width="9%">Email</td>
                <td width="9%">Função/missão</td>
            </tr>
        </thead>
        <tbody>';
    
    
        for($i = 0; $i < sizeof($participantes); $i++){
            $strCursos = '';
            $cursosDoParticipante = $dataAcessObject->obterCursoAssociado($participantes[$i]->getId());
            for ($j = 0; $j < sizeof($cursosDoParticipante); $j++) { 
                $strCursos .= $cursosDoParticipante[$j]->funcaoTexto.'; '; 
            }
            
            $templatePDF .='
            <tr>
                <td colspan="7"><hr/></td>
            </tr>
            <tr>
                <td>'.$participantes[$i]->getNome().'</td>
                <td>'.$participantes[$i]->getDataNasc(2).'</td>
                <td>'.$participantes[$i]->getCidadeTexto().' - '.$participantes[$i]->getEstadoSigla().'</td>
                <td>'.$participantes[$i]->getLocalCurso().'</td>
                <td>'.$participantes[$i]->getTelefone().'</td>
                <td>'.$participantes[$i]->getEmail1().'</td>
                <td>'.$strCursos .'</td>
            </tr>';
        }
    
    $templatePDF .= '
    
        </tbody>
    </table>
    <hr/>
    <div class="rodape">Copyright 2012 | Enchei-vos - Todos os Direitos Reservados</div>
</div></body></html>';
    
    $nomeArquivo = 'Participantes';


}else{
    $participante = $dataAcessObject->getParticipante($_GET['id']);
    $info_sacramentos =  $dataAcessObject->ObterInformacaoSacramento($participante->getInfoSacramento());
    $veiculos = $dataAcessObject->ObterVeiculos($participante->getVeiculo());
    $setoresVoluntariado = $dataAcessObject->ObterSetores($participante->getSetor());
    
    $cursosDoParticipante = $dataAcessObject->obterCursoAssociado($participante->getId());
    $strCursos = '';
    for ($i = 0; $i < sizeof($cursosDoParticipante); $i++) { 
        $strCursos .= $cursosDoParticipante[$i]->cursoTexto.'; '; 
    }
    
    $templatePDF = '<html>
                    <title></title>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head>
                    <body>
                    <div id="content-pdf">

    <style type="text/css">
        h1{font-size: 16px; color: #333; margin-bottom: 10px; position: relative}
        tr{
            border: 1px solid #666;
        }
        
        .negrito{font-weight: bold}
        hr{color: #ccc}
        .rodape{font-size: 10px}
        
        table{font-size: 8px; min-heigth: 80%}
    </style>

    <h1>
        Dados do Participante
    </h1>
    <br/>

    <table width="100%" heigth="80%">               
            <tr>
                <td class="negrito">Nome:</td>
                <td>'.$participante->getNome().'</td>
            </tr>
            <tr>
                <td class="negrito">Data de Nascimento:</td>
                <td>'. $participante->getDataNasc(2).'</td>
            </tr>
            <tr>
                <td class="negrito">Sexo:</td>
                <td>'. $participante->getSexoTexto().'</td>
            </tr>
            <tr>
                <td class="negrito">Estado Civil:</td>
                <td>'.$participante->getEstadoCivil().'</td>
            </tr>
            <tr>
                <td class="negrito">Endere&ccedil;o:</td>
                <td>'. $participante->getEndereco().'</td>
            </tr>
            <tr>
                <td class="negrito">Bairro:</td>
                <td>'. $participante->getBairro().'</td>
            </tr>
            <tr>
                <td class="negrito">Cidade:</td>
                <td>'. $participante->getCidadeTexto().'</td>
            </tr>
            <tr>
                <td class="negrito">Estado:</td>
                <td>'. $participante->getEstadoTexto().'</td>
            </tr>
            <tr>
                <td class="negrito">Fun&ccedil;ao/Missao:</td>
                <td>'. $participante->getFuncaoMissao().'</td>
            </tr>
            <tr>
                <td class="negrito">Local/Curso:</td>
                <td>'. $strCursos.'</td>
            </tr>
            <tr>
                <td class="negrito">Telefone:</td>
                <td>'. $participante->getTelefone().'</td>
            </tr>
            <tr>
                <td class="negrito">Celular:</td>
                <td>'.$participante->getCelular1().'</td>
            </tr>
            <tr>
                <td class="negrito">E-mail:</td>
                <td>'. $participante->getEmail1().'</td>
            </tr>
            <tr>
                <td class="negrito">Profissao:</td>
                <td>'.$participante->getProfissao().'</td>
            </tr>
            <tr>
                <td class="negrito">Institui&ccedil;ao em que Trabalha:</td>
                <td>'.$participante->getInstituicaoNome().'</td>
            </tr>
            <tr>
                <td class="negrito">Endere&ccedil;o Comercial:</td>
                <td>'.$participante->getInstituicaoEndereco().'</td>
            </tr>
            <tr>
                <td class="negrito">Bairro Comercial:</td>
                <td>'.$participante->getInstituicaoBairro().'</td>
            </tr>
            <tr>
                <td class="negrito">Sacramentos:</td>
                <td>'. $info_sacramentos.'</td>
            </tr>
            <tr>
                <td class="negrito">Volunt&aacute;rio:</td>
                <td>'.$setoresVoluntariado.'</td>
            </tr>
            <tr>
                <td class="negrito">Ve&iacute;culo:</td>
                <td>'.$veiculos.'</td>
            </tr>
    </table>
        
        <hr/>
    <div class="rodape">Copyright 2012 | Enchei-vos - Todos os Direitos Reservados</div>
</div></body></html>';
                            
    $nomeArquivo = 'Participante';
}

    $dompdf = new DOMPDF();
    $dompdf->load_html($templatePDF);
    $dompdf->set_paper('letter');
    $dompdf->render();
    $dompdf->stream($nomeArquivo.".pdf");
?>


