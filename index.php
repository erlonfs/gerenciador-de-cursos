<?php
session_start();

$url = "principal";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['associar'])) {
    $associar = $_GET['associar'];
}
if (isset($_GET["url"])) {
    $url = $_GET["url"];
}
if (empty($_SESSION['usuario'])) {
    @header("location:login.php");
}

include_once 'classes/Config.php';
include_once 'classes/Conexao.php';
include_once 'classes/Mensagem.php';
include_once 'classes/ManipulaDados.php';

include_once 'data/CursoDAO.php';
include_once 'data/ParticipanteDAO.php';
include_once 'data/UsuarioDAO.php';
include_once 'data/HelperDAO.php';

include_once 'entities/Curso.php';
include_once 'entities/CursoAssociado.php';
include_once 'entities/Participante.php';
include_once 'entities/Usuario.php';
include_once 'entities/Estado.php';
include_once 'entities/Cidade.php';
include_once 'entities/Lista.php';
include_once 'classes/Helper.php';

$helperDa = new HelperDAO();
$helper = new Helper();

$estados = $helperDa->ObterEstados();
$semestres = $helperDa->ObterSemestres();
$mensagem = Mensagem::ObterMensagens();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <!--<meta charset="utf-8">-->
        <title>Enchei-vos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
        <!-- Le styles -->
        <link href="<?php echo Config::$UrlBase . 'css/bootstrap-responsive.css' ?>" rel="stylesheet" />
        <link href="<?php echo Config::$UrlBase . 'css/bootstrap.css" rel="stylesheet' ?>" />
        <link href="<?php echo Config::$UrlBase . 'css/estilos.css" rel="stylesheet' ?>" type="text/css" />

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?php echo Config::$UrlBase . 'js/jquery.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/page.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/aniversariante.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/utilities.js' ?>"></script>

        <script type="text/javascript">
            $(function() {
                
                //////////////////////////PAGE/////////////////////////////////
            
                Page.load($('#container'));
                Page.settings.urls.obterMunicipios = '<?php echo Config::$UrlBase . 'actions/helperObterMunicipioPorEstado.php' ?>';                                                  
                Page.settings.urls.atualizarSemestre = '<?php echo Config::$UrlBase . 'actions/helperAtualizarSemestre.php' ?>';                                                  
                Page.settings.urls.gerenciarExibirMensagem = '<?php echo Config::$UrlBase . 'actions/helperGerenciarMsg.php' ?>';
                
                Aniversariante.load($('#containerAniversariante'));                
                Aniversariante.settings.urls.obterConteudoModal = '<?php echo Config::$UrlBase.'actions/helperObterConteudoModalParticipante.php'; ?>';
                
                
                ////////////////////////////////Paginador//////////////////////////////////
                
                $('#data-table').dataTable({
                       "oLanguage": {
                            "sLengthMenu": "Mostrar _MENU_ registro(s) por pagina",
                            "sZeroRecords": "Nenhum registro encontrado.",
                            "sInfo": "Mostrando de _START_ ate _END_ de _TOTAL_ registro(s)",
                            "sInfoEmpty": "Mostrando 0 de 0 registros encontrado(s)",
                            "sInfoFiltered": "(filtrado de _MAX_ total de registro(s))"
                       }
                });
                
                $('#data-table_length').attr('style', 'width: 60%; display: inline-block');
                $('#data-table_filter').attr('style', 'width: 40%; display: inline-block; text-align: right');                
                $('#data-table_info').attr('style', 'width: 60%; display: inline-block');
                $('#data-table_paginate').attr('style', 'width: 40%; display: inline-block; text-align: right');                
                $('#data-table_previous').html('Anterior').attr('style', 'margin: 0 15px 0 0').attr('href', '#');
                $('#data-table_next').html('Proximo').attr('href', '#');
                
                
                ////////////////////////////////Paginador//////////////////////////////////
                
                
                $('.btBarraLateral').click(
                function(){
                    if($('.barraLateral').css('right') == '-5px'){
                        $('.barraLateral').animate({right: '-480px'}, 'fast');
                        $(this).removeClass('aberto');

                    } else {
                        $('.barraLateral').animate({right: '-5px'}, 'fast');
                        $(this).addClass('aberto');
                    }
                }
            );

                // Para modal-fluid
                {
                    $('.modalFluid').css({ 'marginLeft': - ($('.modalFluid').width() / 2)}).find('.modal-body').css({'max-height': $(window).height() - 180
                    }).end().css({'marginTop': - ($('.modalFluid').outerHeight() / 2)});}
                $(window).resize( function(){
                    if(!$(window).width() < 800){
                        alignModal();
                    }
                })
                alignModal();
            });                           
            
        </script>       

        <style type="text/css">            
            .boxMsg{width: 50%; min-height: 10px; position: absolute; margin: 3% 0 0 0; padding: 2px 25px; font-size: 11px}
            .boxMsg h3{font-size: 15px; font-weight: 600}
            .boxMsg ul li {font-size: 15px }
            .boxMsg a{color: #000; float: right; top: 0; position: relative}
            .erroMsg{border: 1px solid gold; background-color: #ffffcc; color: red; }
            .sucessoMsg{border: 1px solid #008000; background-color: #ccffcc; color: #006666; }
            .alertMsg{border: 1px solid gold; background-color: #ffffcc; color: red;}            
            
            
        </style>
    </head>   

    <body>
        <?php include_once 'includes/aniversariantes.php'; ?>
       
        <?php if ($helperDa->ObterSemestreAtualId() != $_SESSION['usuario_semestre'] && $_SESSION['exibir_msg']) { ?>
            <div class="box-alerta boxMsg alertMsg">
                <a href="#" class="linkFechar" title="Fechar">X</a>
                <h3>Mensagem(s) do sistema</h3>
                <ul>
                    <li>Aten&ccedil;&atilde;o: O semestre selecionado est&aacute; diferente do semestre atual!</li>
                </ul>
            </div>        
        <?php } ?>
            
        <div class="containerTopo">
            <div class="usuario">                              
                <div class="btn-group pull-right">
                    <a class="btn" href="#"><i class="icon-user"></i> <?php echo $_SESSION['usuario_nome']; ?></a>
                    <a class="btn btn-danger" href="<?php echo Config::$UrlBase . 'logout.php'; ?>"><i class="icon-remove icon-white"></i> Sair</a>
                </div>                                
            </div>

            <div class="logo"><img src="<?php echo Config::$UrlBase . 'img/logo.jpg' ?>" width="208" height="64"></div>
            <div class="menu">    
                <div id="menu">
                    <ul>
                        <li><a href="<?php echo Config::$UrlBase ?>"><i class="icon-home icon-white"></i> Home</a></li>
                        <?php if (Helper::permite($_SESSION['usuario_tipo'], 'usuarios')) { ?> <li><a href="<?php echo Config::$UrlBase . '?url=usuarios' ?>"><i class="icon-user icon-white"></i> Usuarios</a></li><?php } ?>
                        <li><a href="<?php echo Config::$UrlBase . '?url=cursos' ?>"><i class="icon-book icon-white"></i> Cursos </a></li>
                        <li><a href="<?php echo Config::$UrlBase . '?url=participantes' ?>"><i class="icon-list-alt icon-white"></i> Participantes</a></li>
                        <li class="pull-left">
                         <select style="width:130px; margin: 0 5px 0 5px;" class="ddlSemestre">
                                <?php for ($i = 0; $i < sizeof($semestres); $i++) { ?>
                                <option <?php echo $semestres[$i]->id == intval($_SESSION['usuario_semestre']) ?  'selected="selected"' : ''; ?> value="<?php echo $semestres[$i]->id; ?>"><?php echo $semestres[$i]->texto; ?></option>
                                <?php } ?>
                          </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- containerTopo -->

        <div class="container-geral" id="container">
            <?php include_once 'includes/' . $url . '.php'; ?>           
            
            <div id="myModal" class="modalFluid hide fade"></div>
        </div><!-- container-geral -->

        <div class="rodape">Copyright &COPY; <?php echo date('Y'); ?> | Enchei-vos - Todos os Direitos Reservados | vers&abreve;o 1.7.0</div>
        
        <?php echo isset($_SESSION['teste']) ? $_SESSION['teste'] : null;?>

        <script src="<?php echo Config::$UrlBase . 'js/jquery.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/utilities.js' ?>"></script>    
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-transition.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-alert.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-modal.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-dropdown.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-scrollspy.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-tab.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-tooltip.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-popover.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-button.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-collapse.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-carousel.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/bootstrap-typeahead.js' ?>"></script>
        <script src="<?php echo Config::$UrlBase . 'js/jquery.datatable.js' ?>"></script>
    </body>    
</html>