<?php 
    
    $usuario = $dataAcess->getUsuario($id);
    $cidades = $helperDa->ObterMunicipios($usuario->getEstado() != null ? $usuario->getEstado() : 0);
?>

<div class="tab-pane active" id="tab1">
    <pre class="titulo">Editar usu&aacute;rio</pre>	 
    <form class="well">
        <div class="row-fluid">
            <div class="span6">
                <label>Nome Completo *</label>
                <input type="hidden" name="id" class="hdnId" value="<?php echo $usuario->getId(); ?>"/>
                <input type="text" class="span12 txtNome" value="<?php echo $usuario->getNome(); ?>">
            </div>
            <div class="span3">
                <label>Data de Nascimento *</label>
                <input type="date" class="span12 txtDataNasc"  value="<?php echo $usuario->getDataNasc(); ?>">
            </div>
            <div class="span3">
                <label>Sexo *</label>
                <input class="radio rbdSexo" type="radio" <?php echo $usuario->getSexo() == 'M' ? 'checked="checked"' : ''; ?> name="RadioGroup1" value="M" id="RadioGroup1_0">&nbsp; Masculino &nbsp; &nbsp;| &nbsp; &nbsp;
                <input class="radio rbdSexo" type="radio" <?php echo $usuario->getSexo() == 'F' ? 'checked="checked"' : ''; ?> name="RadioGroup1" value="F" id="RadioGroup1_1">&nbsp; Feminino
            </div>

            <div class="row-fluid">   
                <div class="span9">
                    <label>Endere&ccedil;o *</label>
                    <input type="text" class="span12 txtEndereco" value="<?php echo $usuario->getEndereco(); ?>">
                </div>
                <div class="span3">
                    <label>N&ordm; *</label>
                    <input type="text" class="span12 txtNumero" value="<?php echo $usuario->getNumero(); ?>">
                </div>
            </div>    
            <div class="row-fluid">   
                <div class="span5">
                    <label>Bairro *</label>
                    <input type="text" class="span12 txtBairro" value="<?php echo $usuario->getBairro(); ?>">
                </div>
                <div class="span3">
                    <label>CEP *</label>
                    <input type="text" class="span12 txtCep"  value="<?php echo $usuario->getCep(); ?>">
                </div>
                <div class="span2">
                    <label>Estado</label>
                    <select class="span12 ddlEstados" name="estado" id="select01">
                        <option value="0">Selecione...</option>
                        <?php for ($i = 0; $i < sizeof($estados); $i++) { ?>
                        <option <?php echo $estados[$i]->id == $usuario->getEstado() ?  'selected="selected"' : ''; ?> value="<?php echo $estados[$i]->id; ?>"><?php echo $estados[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="span2">
                    <label>Cidade</label>
                    <select class="span12 ddlMunicipios" name="cidade" id="select01">
                        <option value="0">Selecione...</option>   
                        <?php for ($i = 0; $i < sizeof($cidades); $i++) { ?>
                        <option <?php echo $cidades[$i]->id == $usuario->getCidade() ?  'selected="selected"' : ''; ?> value="<?php echo $cidades[$i]->id; ?>"><?php echo $cidades[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span12">
                    <label>Complemento</label>
                    <input type="text" class="span12 txtComplemento" value="<?php echo $usuario->getComplemento(); ?>">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span3">
                    <label>Telefone fixo *</label>
                    <input type="text" class="span12 txtTelefone" value="<?php echo $usuario->getTelefone(); ?>">
                </div>
                <div class="span3">
                    <label>Celular 01 *</label>
                    <input type="text" class="span12 txtCelular1" value="<?php echo $usuario->getCelular1(); ?>">
                </div>
                <div class="span3">
                    <label>Celular 02</label>
                    <input type="text" class="span12 txtCelular2" value="<?php echo $usuario->getCelular2(); ?>">
                </div>
                <div class="span3">
                    <label>Celular 03</label>
                    <input type="text" class="span12 txtCelular3" value="<?php echo $usuario->getCelular3(); ?>">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span6">
                    <label>E-mail 01 *</label>
                    <input type="text" class="span12 txtEmail1" value="<?php echo $usuario->getEmail1(); ?>">  
                </div> 
                <div class="span6">
                    <label>E-mail 02</label>
                    <input type="text" class="span12 txtEmail2" value="<?php echo $usuario->getEmail2(); ?>">  
                </div>                              
            </div>
            <div class="row-fluid">   
                <div class="span4">
                    <label class="titulo">Login *</label>
                    <input type="text" disabled="disabled" class="span12 txtLogin" value="<?php echo $usuario->getLogin(); ?>">  
                </div> 
                <div class="span4">
                    <label class="titulo">Senha *</label>
                    <input type="password" class="span12 txtSenha" value="<?php echo $usuario->getSenha(); ?>">  
                </div>
                <div class="span4">
                    <label class="titulo">Confirmar Senha *</label>
                    <input type="password" class="span12 txtConfirmarSenha" value="<?php echo $usuario->getSenha(); ?>">  
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