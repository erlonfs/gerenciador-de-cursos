<div class="tab-pane" id="tab1">
    <pre class="titulo">Cadastrar novo participante</pre>	
    <form class="well">
        <div class="row-fluid">
            <div class="span3">
                <label>CPF *</label>
                <input type="text" class="span12 txtCpfCnpj"/>
            </div>
            
            <div class="span2">
                <label>&nbsp;</label>
                <a class="btn btn-primary btn-success btnVerificarCpfCnpj"  data-toggle="tab"><i class="icon-search"></i> Verificar</a>
            </div>
            
            <div class="span7">
                <label>Nome Completo *</label>
                <input type="text" class="span12 txtNome disable">
                <input type="hidden" name="id" class="hdnId" value="0"/>
            </div>           
        </div>

        <div class="row-fluid">            
            <div class="span2">
                <label>Data de Nascimento *</label>
                <input type="date" class="span12 txtDataNasc disable"/>
            </div>
            <div class="span3">
                <label>Sexo *</label>
                <input class="radio rbdSexo disable" type="radio" value="M" name="RadioGroup1" value="radio" id="RadioGroup1_0">&nbsp; Masculino &nbsp; &nbsp;| &nbsp; &nbsp;
                <input class="radio rbdSexo disable" type="radio" value="F" name="RadioGroup1" value="radio" id="RadioGroup1_1">&nbsp; Feminino
            </div>
            
            <div class="span6">
                <label>Endere&ccedil;o *</label>
                <input type="text" class="span12 txtEndereco disable">
            </div>
            <div class="span1">
                <label>N&ordm; *</label>
                <input type="text" class="span12 txtNumero disable">
            </div>
        </div>  
        
        <div class="row-fluid">   
            <div class="span5">
                <label>Bairro *</label>
                <input type="text" class="span12 txtBairro disable">
            </div>
            <div class="span3">
                <label>CEP *</label>
                <input type="text" class="span12 txtCep disable">
            </div>                               
            <div class="span2">
                <label>Estado *</label>
                <select class="span12 ddlEstados disable" id="select01">
                    <option value="0">Selecione...</option>
                    <?php for ($i = 0; $i < sizeof($estados); $i++) { ?>
                        <option value="<?php echo $estados[$i]->id; ?>"><?php echo $estados[$i]->nome; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="span2">
                <label>Cidade *</label>
                <select class="span12 ddlMunicipios disable" name="cidade" id="select01">
                    <option value="0">Selecione...</option>                                        
                </select>
            </div>
        </div>
        
        <div class="row-fluid">   
            <div class="span12">
                <label>Complemento</label>
                <input type="text" class="span12 txtComplemento disable">
            </div>
        </div>
        
        <div class="row-fluid">   
            <div class="span3">
                <label>Telefone fixo *</label>
                <input type="text" class="span12 txtTelefone disable">
            </div>
            <div class="span3">
                <label>Celular 01 *</label>
                <input type="text" class="span12 txtCelular1 disable">
            </div>
            <div class="span3">
                <label>Celular 02</label>
                <input type="text" class="span12 txtCelular2 disable">
            </div>
            <div class="span3">
                <label>Celular 03</label>
                <input type="text" class="span12 txtCelular3 disable">
            </div>
        </div>
        
        <div class="row-fluid">   
            <div class="span6">
                <label>E-mail 01 *</label>
                <input type="text" class="span12 txtEmail1 disable">  
            </div> 
            <div class="span6">
                <label>E-mail 02</label>
                <input type="text" class="span12 txtEmail2 disable">  
            </div>                              
        </div>
        
        <div class="row-fluid">   
            <div class="span6">
                <label>Nome da M&atilde;e Respons&aacute;vel, Tutor ou Parentesco</label>
                <input type="text" class="span12 txtNomeMaeResponsavel disable">
            </div>
            <div class="span6">
                <label>Nome do Pai, Respons&aacute;vel, Tutor ou Parentesco</label>
                <input type="text" class="span12 txtNomePaiResponsavel disable">
            </div>
        </div>
        
        <div class="row-fluid">   
            <div class="span3">
                <label>Estado Civil</label>
                <input type="text" class="span12 txtEstadoCivil disable">
            </div>
            <div class="span9">
                <label>Nome do(a) C&ocirc;njuge / Companheiro(a)</label>
                <input type="text" class="span12 txtNomeConjuge disable">
            </div>
        </div>
        
        <div class="row-fluid">   
            <div class="span7">
                <label>Institui&ccedil;&abreve;o em que Trabalha</label>
                <input type="text" class="span12 txtInstituicaoNome disable">
            </div>
            <div class="span5">
                <label>Profiss&abreve;o</label>
                <input type="text" class="span12 txtProfissao disable">
            </div>
        </div>
        
        <div class="row-fluid">   
            <div class="span9">
                <label>Endere&ccedil;o Comercial</label>
                <input type="text" class="span12 txtInstituicaoEndereco disable">
            </div>
            <div class="span3">
                <label>N&ordm;</label>
                <input type="text" class="span12 txtInstituicaoNumero disable">
            </div>
        </div>    
        
        <div class="row-fluid">   
            <div class="span5">
                <label>Bairro</label>
                <input type="text" class="span12 txtInstituicaoBairro disable">
            </div>
            <div class="span3">
                <label>CEP</label>
                <input type="text" class="span12 txtInstituicaoCep disable">
            </div>                               
            <div class="span2">
                <label>Estado</label>
                <select class="span12 ddlEstados ddlInstituicaoEstados disable" id="select01">
                    <option value="0">Selecione...</option>
                    <?php for ($i = 0; $i < sizeof($estados); $i++) { ?>
                        <option value="<?php echo $estados[$i]->id; ?>"><?php echo $estados[$i]->nome; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="span2">
                <label>Cidade</label>
                <select class="span12 ddlMunicipios ddlInstituicaoMunicipios disable" name="cidade" id="select01">
                    <option value="0">Selecione...</option>
                </select>
            </div>
        </div>

        <div class="row-fluid">   
            <div class="span12">
                <label>Informa&ccedil;&odblac;es quanto aos Sacramentos</label>                    
                <?php for($i = 0; $i < sizeof($info_sacramentos); $i++){ ?>                    
                <input class="checkbox ckbSacramento disable" value="<?php echo $info_sacramentos[$i]->valor; ?>" type="checkbox">&nbsp; <?php echo $info_sacramentos[$i]->texto; ?> &nbsp; &nbsp;| &nbsp; &nbsp;                     
                <?php }?>
            </div>
        </div>   
        
        <hr>
        <div class="row-fluid">   
            <div class="span12">
                <label>Na Miss&abreve;o Enchei-vos gostaria de ajudar em qual desses setores?</label>
                <?php for($i = 0; $i < sizeof($setores); $i++){ ?>                    
                    <input class="checkbox ckbSetor disable" value="<?php echo $setores[$i]->valor; ?>" type="checkbox">&nbsp; <?php echo $setores[$i]->texto; ?> &nbsp; &nbsp;| &nbsp; &nbsp;                     
                <?php }?>
            </div>
        </div> 
        
        <hr>
        <div class="row-fluid">   
            <div class="span12">
                <label>Possui ve&iacute;culos</label>
                <?php for($i = 0; $i < sizeof($veiculos); $i++){ ?>                    
                    <input class="checkbox ckbVeiculo disable" value="<?php echo $veiculos[$i]->valor; ?>" type="checkbox">&nbsp; <?php echo $veiculos[$i]->texto; ?> &nbsp; &nbsp;| &nbsp; &nbsp;                     
                <?php }?>
            </div>
        </div> 
        
        <hr/>
        <div class="row-fluid">   
            <div class="span9">
                <label>Observa&ccedil;&odblac;es</label>
                <input type="text" class="span12 txtObservacoes disable" />
            </div>
        </div>
        
        <hr>
        <div class="pull-right">
            <a class="btn btn-primary btn-large btnSalvar"  data-toggle="tab"><i class="icon-ok icon-white"></i> Salvar</a>
            <button type="reset" class="btn btn-danger btn-large"><i class="icon-remove icon-white"></i> Cancelar</button>
        </div>       
    </form>
</div>