<div class="tab-pane" id="tab1">
    <pre class="titulo">Cadastrar novo usu&aacute;rio</pre>	
    <form class="well">
        <div class="row-fluid">
            <div class="span6">
                <label>Nome Completo *</label>
                <input type="text" class="span12 txtNome">
            </div>
            <div class="span3">
                <label>Data de Nascimento *</label>
                <input type="date" class="span12 txtDataNasc">
            </div>
            <div class="span3">
                <label>Sexo *</label>
                <input class="radio rbdSexo" type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_0">&nbsp; Masculino &nbsp; &nbsp;| &nbsp; &nbsp;
                <input class="radio rbdSexo" type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_1">&nbsp; Feminino
            </div>

            <div class="row-fluid">   
                <div class="span9">
                    <label>Endere&ccedil;o *</label>
                    <input type="text" class="span12 txtEndereco">
                </div>
                <div class="span3">
                    <label>N&ordm; *</label>
                    <input type="text" class="span12 txtNumero">
                </div>
            </div>    
            <div class="row-fluid">   
                <div class="span5">
                    <label>Bairro *</label>
                    <input type="text" class="span12 txtBairro">
                </div>
                <div class="span3">
                    <label>CEP *</label>
                    <input type="text" class="span12 txtCep">
                </div>
                <div class="span2">
                    <label>Estado *</label>
                    <select class="span12 ddlEstados" id="select01">
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
            <div class="row-fluid">   
                <div class="span12">
                    <label>Complemento</label>
                    <input type="text" class="span12 txtComplemento">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span3">
                    <label>Telefone fixo *</label>
                    <input type="text" class="span12 txtTelefone">
                </div>
                <div class="span3">
                    <label>Celular 01 *</label>
                    <input type="text" class="span12 txtCelular1">
                </div>
                <div class="span3">
                    <label>Celular 02</label>
                    <input type="text" class="span12 txtCelular2">
                </div>
                <div class="span3">
                    <label>Celular 03</label>
                    <input type="text" class="span12 txtCelular3">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span6">
                    <label>E-mail 01 *</label>
                    <input type="text" class="span12 txtEmail1">  
                </div> 
                <div class="span6">
                    <label>E-mail 02</label>
                    <input type="text" class="span12 txtEmail2">  
                </div>                              
            </div>
            <div class="row-fluid">   
                <div class="span4">
                    <label class="titulo">Login *</label>
                    <input type="text" class="span12 txtLogin">  
                </div> 
                <div class="span4">
                    <label class="titulo">Senha *</label>
                    <input type="password" class="span12 txtSenha">  
                </div>
                <div class="span4">
                    <label class="titulo">Confirmar Senha *</label>
                    <input type="password" class="span12 txtConfirmarSenha">  
                </div>                              
            </div>
            <hr>
            <div class="pull-right">
                <a class="btn btn-primary btn-large btnSalvar" data-toggle="tab"><i class="icon-ok icon-white"></i> Salvar</a>
                <button type="button" class="btn btn-danger btn-large"><i class="icon-remove icon-white"></i> Cancelar</button>
            </div>
        </div>
    </form>
</div>