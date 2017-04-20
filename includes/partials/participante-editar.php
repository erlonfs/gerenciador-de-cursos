<?php    

    if(isset($_GET['cpf'])){
        $participante = $dataAcess->getParticipantePorCpfCnpj($_GET['cpf']);
    }else{
        $participante = $dataAcess->getParticipante($id);
    }
    
    if($participante->getId() == 0){        
        @header("location:".Config::$UrlBase.'?participantes');        
    }
    
    $cidades = $helperDa->ObterMunicipios($participante->getEstado() != null ? $participante->getEstado() : 0);
    $cidadesInstituicao = $helperDa->ObterMunicipios($participante->getInstituicaoEstado() != null ? $participante->getInstituicaoEstado() : 0);
?>


<div class="tab-pane active" id="tab1">
    <pre class="titulo">Editar participante</pre>	
    <form class="well">
        <div class="row-fluid">
            <div class="span3">
                <label>CPF *</label>
                <input type="text" disabled="disabled" class="span12 txtCpfCnpj" value="<?php echo $participante->getCpfCnpj(); ?>"/>
            </div>
            
            <div class="span2">
               
            </div>
            
            <div class="span7">
                <label>Nome Completo *</label>
                <input type="text" class="span12 txtNome" value="<?php echo $participante->getNome(); ?>" />
                <input type="hidden" name="id" class="hdnId" value="<?php echo $participante->getId(); ?>"/>                
            </div>                                   

            <div class="row-fluid">   
                <div class="span2">
                    <label>Data de Nascimento *</label>
                    <input type="date" class="span12 txtDataNasc" value="<?php echo $participante->getDataNasc(); ?>">
                </div>
                <div class="span3">
                    <label>Sexo *</label>
                    <input class="radio rbdSexo" <?php echo $participante->getSexo() == 'M' ? 'checked="checked"' : ''; ?> type="radio" value="M" name="RadioGroup1" value="radio" id="RadioGroup1_0">&nbsp; Masculino &nbsp; &nbsp;| &nbsp; &nbsp;
                    <input class="radio rbdSexo" <?php echo $participante->getSexo() == 'F' ? 'checked="checked"' : ''; ?> type="radio" value="F" name="RadioGroup1" value="radio" id="RadioGroup1_1">&nbsp; Feminino
                </div>
                
                <div class="span6">
                    <label>Endere&ccedil;o *</label>
                    <input type="text" class="span12 txtEndereco" value="<?php echo $participante->getEndereco(); ?>">
                </div>
                <div class="span1">
                    <label>N&ordm; *</label>
                    <input type="text" class="span12 txtNumero" value="<?php echo $participante->getNumero(); ?>">
                </div>
            </div>    
            <div class="row-fluid">   
                <div class="span5">
                    <label>Bairro *</label>
                    <input type="text" class="span12 txtBairro" value="<?php echo $participante->getBairro(); ?>">
                </div>
                <div class="span3">
                    <label>CEP *</label>
                    <input type="text" class="span12 txtCep" value="<?php echo $participante->getCep(); ?>">
                </div>                               
                <div class="span2">
                    <label>Estado</label>
                    <select class="span12 ddlEstados" name="estado" id="select01">
                        <option value="0">Selecione...</option>
                        <?php for ($i = 0; $i < sizeof($estados); $i++) { ?>
                        <option <?php echo $estados[$i]->id == $participante->getEstado() ?  'selected="selected"' : ''; ?> value="<?php echo $estados[$i]->id; ?>"><?php echo $estados[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="span2">
                    <label>Cidade</label>
                    <select class="span12 ddlMunicipios" name="cidade" id="select01">
                        <option value="0">Selecione...</option>   
                        <?php for ($i = 0; $i < sizeof($cidades); $i++) { ?>
                        <option <?php echo $cidades[$i]->id == $participante->getCidade() ?  'selected="selected"' : ''; ?> value="<?php echo $cidades[$i]->id; ?>"><?php echo $cidades[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span12">
                    <label>Complemento</label>
                    <input type="text" class="span12 txtComplemento" value="<?php echo $participante->getComplemento(); ?>">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span3">
                    <label>Telefone fixo *</label>
                    <input type="text" class="span12 txtTelefone" value="<?php echo $participante->getTelefone(); ?>">
                </div>
                <div class="span3">
                    <label>Celular 01 *</label>
                    <input type="text" class="span12 txtCelular1" value="<?php echo $participante->getCelular1(); ?>">
                </div>
                <div class="span3">
                    <label>Celular 02</label>
                    <input type="text" class="span12 txtCelular2" value="<?php echo $participante->getCelular2(); ?>">
                </div>
                <div class="span3">
                    <label>Celular 03</label>
                    <input type="text" class="span12 txtCelular3" value="<?php echo $participante->getCelular3(); ?>">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span6">
                    <label>E-mail 01 *</label>
                    <input type="text" class="span12 txtEmail1" value="<?php echo $participante->getEmail1(); ?>">  
                </div> 
                <div class="span6">
                    <label>E-mail 02</label>
                    <input type="text" class="span12 txtEmail2" value="<?php echo $participante->getEmail2(); ?>">  
                </div>                              
            </div>
            <div class="row-fluid">   
                <div class="span6">
                    <label>Nome da M&atilde;e Respons&aacute;vel, Tutor ou Parentesco</label>
                    <input type="text" class="span12 txtNomeMaeResponsavel" value="<?php echo $participante->getNomeMae(); ?>">
                </div>
                <div class="span6">
                    <label>Nome do Pai, Respons&aacute;vel, Tutor ou Parentesco</label>
                    <input type="text" class="span12 txtNomePaiResponsavel" value="<?php echo $participante->getNomePai(); ?>">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span3">
                    <label>Estado Civil</label>
                    <input type="text" class="span12 txtEstadoCivil" value="<?php echo $participante->getEstadoCivil(); ?>">
                </div>
                <div class="span9">
                    <label>Nome do(a) C&ocirc;njuge / Companheiro(a)</label>
                    <input type="text" class="span12 txtNomeConjuge" value="<?php echo $participante->getNomeConjugue(); ?>">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span7">
                    <label>Institui&ccedil;&abreve;o em que Trabalha</label>
                    <input type="text" class="span12 txtInstituicaoNome" value="<?php echo $participante->getInstituicaoNome(); ?>">
                </div>
                <div class="span5">
                    <label>Profiss&abreve;o</label>
                    <input type="text" class="span12 txtProfissao" value="<?php echo $participante->getProfissao(); ?>">
                </div>
            </div>
            <div class="row-fluid">   
                <div class="span9">
                    <label>Endere&ccedil;o Comercial</label>
                    <input type="text" class="span12 txtInstituicaoEndereco" value="<?php echo $participante->getInstituicaoEndereco(); ?>">
                </div>
                <div class="span3">
                    <label>N&ordm;</label>
                    <input type="text" class="span12 txtInstituicaoNumero" value="<?php echo $participante->getInstituicaoNumero(); ?>">
                </div>
            </div>    
            <div class="row-fluid">   
                <div class="span5">
                    <label>Bairro</label>
                    <input type="text" class="span12 txtInstituicaoBairro" value="<?php echo $participante->getInstituicaoBairro(); ?>">
                </div>
                <div class="span3">
                    <label>CEP</label>
                    <input type="text" class="span12 txtInstituicaoCep" value="<?php echo $participante->getInstituicaoCep(); ?>">
                </div>                               
                <div class="span2">
                    <label>Estado</label>
                    <select class="span12 ddlEstados ddlInstituicaoEstados" id="select01">
                        <option value="0">Selecione...</option>
                        <?php for ($i = 0; $i < sizeof($estados); $i++) { ?>
                            <option <?php echo $estados[$i]->id == $participante->getInstituicaoEstado() ?  'selected="selected"' : ''; ?> value="<?php echo $estados[$i]->id; ?>"><?php echo $estados[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="span2">
                    <label>Cidade</label>
                    <select class="span12 ddlMunicipios ddlInstituicaoMunicipios" name="cidade" id="select01">
                        <option value="0">Selecione...</option>   
                        <?php for ($i = 0; $i < sizeof($cidadesInstituicao); $i++) { ?>
                        <option <?php echo $cidadesInstituicao[$i]->id == $participante->getInstituicaoCidade() ?  'selected="selected"' : ''; ?> value="<?php echo $cidadesInstituicao[$i]->id; ?>"><?php echo $cidadesInstituicao[$i]->nome; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row-fluid">   
                <div class="span12">
                    <label>Informa&ccedil;&odblac;es quanto aos Sacramentos</label>                    
                    <?php for($i = 0; $i < sizeof($info_sacramentos); $i++){ ?>                    
                    <input class="checkbox ckbSacramento" <?php echo ((intval($info_sacramentos[$i]->valor) & intval($participante->getInfoSacramento())) > 0) ? 'checked="checked"' : ''; ?> value="<?php echo $info_sacramentos[$i]->valor; ?>" type="checkbox">&nbsp; <?php echo $info_sacramentos[$i]->texto; ?> &nbsp; &nbsp;| &nbsp; &nbsp;                     
                    <?php }?>
                </div>
            </div>   
            <hr>
            <div class="row-fluid">   
                <div class="span12">
                    <label>Na Miss&abreve;o Enchei-vos gostaria de ajudar em qual desses setores?</label>
                    <?php for($i = 0; $i < sizeof($setores); $i++){ ?>                    
                    <input class="checkbox ckbSetor" <?php echo ((intval($setores[$i]->valor) & intval($participante->getSetor())) > 0) ? 'checked="checked"' : ''; ?> value="<?php echo $setores[$i]->valor; ?>" type="checkbox">&nbsp; <?php echo $setores[$i]->texto; ?> &nbsp; &nbsp;| &nbsp; &nbsp;
                    <?php }?>
                </div>
            </div> 
            <hr>
            <div class="row-fluid">   
                <div class="span12">
                    <label>Possui ve&iacute;culos</label>
                    <?php for($i = 0; $i < sizeof($veiculos); $i++){ ?>                    
                    <input class="checkbox ckbVeiculo" <?php echo ((intval($veiculos[$i]->valor) & intval($participante->getVeiculo())) > 0) ? 'checked="checked"' : ''; ?> value="<?php echo $veiculos[$i]->valor; ?>" type="checkbox">&nbsp; <?php echo $veiculos[$i]->texto; ?> &nbsp; &nbsp;| &nbsp; &nbsp;
                    <?php }?>

                </div>
            </div>  
            
            <hr/>
            <div class="row-fluid">   
                <div class="span9">
                    <label>Observa&ccedil;&odblac;es</label>
                    <input type="text" class="span12 txtObservacoes" value="<?php echo $participante->getObservacoes(); ?>" />
                </div>
            </div>
            
            <hr>
            <div class="pull-right">
                <a class="btn btn-primary btn-large btnSalvar"  data-toggle="tab"><i class="icon-ok icon-white"></i> Salvar</a>
                <button type="reset" class="btn btn-danger btn-large"><i class="icon-remove icon-white"></i> Cancelar</button>
            </div>
        </div>
    </form>
</div>