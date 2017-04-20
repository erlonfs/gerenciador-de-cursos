<div class="tab-pane" id="tab1">

    <pre class="titulo">Cadastrar novo Curso</pre>	

    <form class="well" action="actions/curso/post.php" method="post">
        <div class="row-fluid">
            <div class="span12">
                <label>Curso/Local *</label>
                <input type="text" name="nome_local" class="span12 txtCursoLocal">
                <input type="hidden" name="id" class="hdnId" value="0"/>
            </div>
            <div class="row-fluid">   
                <div class="span9">
                    <label>Endere&ccedil;o *</label>
                    <input type="text" name="endereco" class="span12 txtEndereco">
                </div>
                <div class="span3">
                    <label>N&ordm; *</label>
                    <input type="text" name="numero" class="span12 txtNumero">
                </div>
            </div>    
            <div class="row-fluid">   
                <div class="span5">
                    <label>Bairro *</label>
                    <input type="text" name="bairro" class="span12 txtBairro">
                </div>
                <div class="span3">
                    <label>CEP *</label>
                    <input type="text" name="cep" class="span12 txtCep">
                </div>
                <div class="span2">
                    <label>Estado *</label>
                    <select class="span12 ddlEstados" name="estado" id="select01">
                        <option value="0">Selecione...</option>
                        <?php for ($i = 0; $i < sizeof($estados); $i++) { ?>
                            <option value="<?php echo $estados[$i]->id; ?>"><?php echo $estados[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="span2">
                    <label>Cidade *</label>
                    <select class="span12 ddlMunicipios" name="cidade" id="select01">
                        <option value="0">Selecione...</option>                                        
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