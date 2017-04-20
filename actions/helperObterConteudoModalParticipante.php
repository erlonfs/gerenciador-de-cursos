<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

include_once '../data/ParticipanteDAO.php';
include_once '../entities/Participante.php';
include_once '../entities/CursoAssociado.php';
include_once '../classes/Conexao.php';
include_once '../classes/Config.php';
include_once '../classes/ManipulaDados.php';

if (isset($_GET['id'])) {

    $dataAcess = new ParticipanteDAO();
    $participante = $dataAcess->getParticipante($_GET['id']);
    $info_sacramentos =  $dataAcess->ObterInformacaoSacramento($participante->getInfoSacramento());
    $veiculos = $dataAcess->ObterVeiculos($participante->getVeiculo());
    $setoresVoluntariado = $dataAcess->ObterSetores($participante->getSetor());
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Dados do Participante</h3>
    </div>
    <div class="modal-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Dados</th>
                    <th>Fornecidos</th>
                </tr>
            </thead>
            <tr>
                <td>Nome:</td>
                <td><?php echo $participante->getNome(); ?></td>
            </tr>
            <tr>
                <td>Data de Nascimento:</td>
                <td><?php echo $participante->getDataNasc(2); ?></td>
            </tr>
            <tr>
                <td>Sexo:</td>
                <td><?php echo $participante->getSexoTexto(); ?></td>
            </tr>
            <tr>
                <td>Estado Civil:</td>
                <td><?php echo $participante->getEstadoCivil(); ?></td>
            </tr>
            <tr>
                <td>Endere&ccedil;o:</td>
                <td><?php echo $participante->getEndereco(); ?></td>
            </tr>
            <tr>
                <td>Bairro:</td>
                <td><?php echo $participante->getBairro(); ?></td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td><?php echo $participante->getCidadeTexto(); ?></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><?php echo $participante->getEstadoTexto(); ?></td>
            </tr>
            <tr>
                <td>Fun&ccedil;&abreve;o / Miss&abreve;o:</td>
                <td><?php echo $participante->getFuncaoMissao(); ?></td>
            </tr>
            <tr>
                <td>Local/Curso:</td>
                <td>
                    <?php
                    
                        $strCursos = '';
                        $cursosDoParticipante = $dataAcess->obterCursoAssociado($participante->getId());
                        for ($i = 0; $i < sizeof($cursosDoParticipante); $i++) { 
                            $strCursos .= $cursosDoParticipante[$i]->cursoTexto.';'; 
                        }
                        
                        echo $strCursos;
                    ?>
                </td>
            </tr>
            <tr>
                <td>Telefone:</td>
                <td><?php echo $participante->getTelefone(); ?></td>
            </tr>
            <tr>
                <td>Celular:</td>
                <td><?php echo $participante->getCelular1(); ?></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><?php echo $participante->getEmail1(); ?></td>
            </tr>
            <tr>
                <td>Profiss&abreve;o:</td>
                <td><?php echo $participante->getProfissao(); ?></td>
            </tr>
            <tr>
                <td>Institui&ccedil;&abreve;o em que Trabalha:</td>
                <td><?php echo $participante->getInstituicaoNome(); ?></td>
            </tr>
            <tr>
                <td>Endere&ccedil;o Comercial:</td>
                <td><?php echo $participante->getInstituicaoEndereco(); ?></td>
            </tr>
            <tr>
                <td>Bairro Comercial:</td>
                <td><?php echo $participante->getInstituicaoBairro(); ?></td>
            </tr>
            <tr>
                <td>Sacramentos:</td>
                <td><?php echo $info_sacramentos; ?></td>
            </tr>
            <tr>
                <td>Voluntario:</td>
                <td><?php echo $setoresVoluntariado; ?></td>
            </tr>
            <tr>
                <td>Ve&iacute;culo:</td>
                <td><?php echo $veiculos; ?></td>
            </tr>

        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" >Fechar</a>
        <a href="<?php echo Config::$UrlBase.'pdf/participantePDF.php?id='.$participante->getId() ?>" class="btn"><i class="icon-file"></i> Gerar PDF</a>
    </div>


    <?php
}?>