<?php
$dataAcess = new UsuarioDAO();
$usuarios = $dataAcess->getList('where 1 = 1');

$localCurso = $helperDa->ObterLocalCurso();
$cursoFuncao = $helperDa->ObterCursoFuncao();

if (!Helper::permite($_SESSION['usuario_tipo'], 'usuarios')) {
    header('location: ' . Config::$UrlBase);
}
?>

<script type="text/javascript" src="js/usuario.js" charset="utf-8"></script>
<script type="text/javascript">      
    Usuario.load($('#container'), {
        urls: {
            salvar: '<?php echo Config::$UrlBase . 'actions/usuario/post.php'; ?>',
            associar: '<?php echo Config::$UrlBase . 'actions/usuario/associar.php'; ?>',
            redirect: '<?php echo Config::$UrlBase . '?url=usuarios'; ?>'
        }});             
</script>

<div class="row-fluid">
    <div class="span12">

        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="<?php echo (!isset($associar) && isset($id)) ? 'active' : '' ?>"><a href="#tab1" class="btAba" data-toggle="tab">Salvar Usu&aacute;rio</a></li>
                <?php if (isset($associar)) { ?><li class="active"><a href="#tab2" class="btAba" data-toggle="tab">Associar</a></li><?php } ?>
                <li class="<?php echo (!isset($associar) && !isset($id)) ? 'active' : '' ?>"><a href="#tab3" class="btAba" data-toggle="tab">Listar</a></li>
            </ul>
            <div class="tab-content">

                <?php isset($id) ? include_once 'partials/usuario-editar.php' : include_once 'partials/usuario-cadastrar.php'; ?>

                <?php if (isset($associar)) include_once 'partials/usuario-associar.php'; ?>

                <?php include_once 'partials/usuario-listar.php'; ?>

            </div>
        </div>

    </div>
</div>