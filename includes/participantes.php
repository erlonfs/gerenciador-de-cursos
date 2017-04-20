<?php         
    $dataAcess = new ParticipanteDAO();            
    $participantes = $dataAcess->getList('where 1 = 1');
    
    $info_sacramentos = $helperDa->ObterInfoSacramentos();
    $setores = $helperDa->ObterSetores();
    $veiculos = $helperDa->ObterVeiculos();
    $localCurso = $helperDa->ObterLocalCurso();
    $cursoFuncao = $helperDa->ObterCursoFuncao();
    
?>
<script type="text/javascript" src="js/participante.js" charset="utf-8"></script>
<script type="text/javascript">      
       Participante.load($('#container'), {
            urls: {
               salvar: '<?php echo Config::$UrlBase.'actions/participante/post.php'; ?>',
               obterConteudoModal: '<?php echo Config::$UrlBase.'actions/helperObterConteudoModalParticipante.php'; ?>',
               associar: '<?php echo Config::$UrlBase.'actions/participante/associar.php'; ?>',
               redirect: '<?php echo Config::$UrlBase.'?url=participantes'; ?>',
               obterPorCpfCnpj: '<?php echo Config::$UrlBase.'actions/helperObterParticipantePorCpfCnpj.php'; ?>',
               base: '<?php echo Config::$UrlBase?>'
       }});              
</script>


<div class="row-fluid">
    <div class="span12">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="<?php echo (!isset($associar) && isset($id)) ? 'active' : '' ?>"><a href="#tab1" class="btAba" data-toggle="tab">Salvar Participante</a></li>
                <?php if(isset($associar)){?><li class="active"><a href="#tab2" class="btAba" data-toggle="tab">Associar</a></li><?php } ?>
                <li class="<?php echo (!isset($associar) && !isset($id)) ? 'active' : '' ?>"><a href="#tab3" class="btAba" data-toggle="tab">Listar</a></li>
            </ul>
            <div class="tab-content">
                
                <?php isset($id) ? include_once 'partials/participante-editar.php' : include_once 'partials/participante-cadastrar.php';?>

                <?php if(isset($associar)) include_once 'partials/participante-associar.php';?>
                
                <?php include_once 'partials/participante-listar.php'; ?>
                               
            </div>
        </div>
    </div>
</div>