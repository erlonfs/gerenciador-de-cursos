<?php    
    $curso = $dataAcess->getCurso($id);
    $cidades = $helperDa->ObterMunicipios($curso->getEstado() != null ? $curso->getEstado() : 0);
?>

<div class="tab-pane active" id="tab1">
    <pre class="titulo">Editar Curso</pre>	

    <form class="well" action="actions/curso/post.php" method="post">
        <div class="row-fluid">
            <div class="span12">
                <label>Curso/Local</label>
                <input type="text" name="nome_local" value="<?php echo $curso->getNomeLocal(); ?>" class="span12 txtCursoLocal">
                <input type="hidden" name="id" class="hdnId" value="<?php echo $curso->getId(); ?>"/>
            </div>
            <div class="row-fluid">   
                <div class="span9">
                    <label>Endere&ccedil;o</label>
                    <input type="text" name="endereco" value="<?php echo $curso->getEndereco(); ?>" class="span12 txtEndereco">
                </div>
                <div class="span3">
                    <label>N&ordm;</label>
                    <input type="text" name="numero" value="<?php echo $curso->getNumero(); ?>" class="span12 txtNumero">
                </div>
            </div>    
            <div class="row-fluid">   
                <div class="span5">
                    <label>Bairro</label>
                    <input type="text" name="bairro"  value="<?php echo $curso->getBairro(); ?>" class="span12 txtBairro">
                </div>
                <div class="span3">
                    <label>CEP</label>
                    <input type="text" name="cep" value="<?php echo $curso->getCep(); ?>" class="span12 txtCep">
                </div>
                <div class="span2">
                    <label>Estado</label>
                    <select class="span12 ddlEstados" name="estado" id="select01">
                        <option value="0">Selecione...</option>
                        <?php for ($i = 0; $i < sizeof($estados); $i++) { ?>
                        <option <?php echo $estados[$i]->id == $curso->getEstado() ?  'selected="selected"' : ''; ?> value="<?php echo $estados[$i]->id; ?>"><?php echo $estados[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="span2">
                    <label>Cidade</label>
                    <select class="span12 ddlMunicipios" name="cidade" id="select01">
                        <option value="0">Selecione...</option>   
                        <?php for ($i = 0; $i < sizeof($cidades); $i++) { ?>
                        <option <?php echo $cidades[$i]->id == $curso->getCidade() ?  'selected="selected"' : ''; ?> value="<?php echo $cidades[$i]->id; ?>"><?php echo $cidades[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>                                
            </div>
            <hr>
            <div class="pull-right">
                <button type="button" class="btn btn-primary btn-large btnSalvar"><i class="icon-ok icon-white"></i> Salvar</button>
                <button type="reset" class="btn btn-danger btn-large"><i class="icon-remove icon-white"></i> Cancelar</button>
            </div>
        </div>
    </form>
</div>