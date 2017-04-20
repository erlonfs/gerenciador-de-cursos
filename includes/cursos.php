<?php         
    $dataAcess = new CursoDAO();            
    $cursos = $dataAcess->getList('where 1 = 1');
    
?>
<script type="text/javascript" src="js/curso.js" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">      
       Curso.load($('#container'), {
            urls: {
               salvar: '<?php echo Config::$UrlBase.'actions/curso/post.php'; ?>',
               redirect: '<?php echo Config::$UrlBase.'?url=cursos'; ?>'
       }});             
</script>
<div class="row-fluid">
    <div class="span12">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="<?php echo (isset($id)) ? 'active' : '' ?>"><a href="#tab1" class="btAba" data-toggle="tab">Salvar Curso</a></li>
                <li class="<?php echo (!isset($id)) ? 'active' : '' ?>"><a href="#tab2" class="btAba" data-toggle="tab">Listar</a></li>
            </ul>
            <div class="tab-content">
                
                <?php isset($id) ? include_once 'partials/curso-editar.php' : include_once 'partials/curso-cadastrar.php';?>

                <?php include_once 'partials/curso-listar.php'; ?>
                
            </div>
        </div>

    </div>
</div>

