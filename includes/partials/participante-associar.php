<?php 
    $participante = $dataAcess->getParticipante($associar);
    $cidades = $helperDa->ObterMunicipios($participante->getEstado() != null ? $participante->getEstado() : 0);
    $cursosAssociados = $dataAcess->obterCursoAssociado($participante->getId());
?>
<div class="tab-pane <?php echo (isset($associar)) ? 'active' : '' ?>" id="tab2">
    <pre class="titulo">Associar participantes</pre>	
    <form class="well">
        <div class="row-fluid">
            <div class="span12">
                <h2><?php echo $participante->getNome(); ?></h2>
                <hr>
            </div>
        </div>
        
        <input type="hidden" class="hdnParticipanteAssociadoId" value="<?php echo $participante->getId() ?>" />

        <div class="row-fluid">   
            <div class="span5">
                <label>Local do Curso Enchei-vos</label>
                <select class="span12 ddllocalCurso" id="select01">
                    <option value="0">Selecione...</option>
                    <?php for ($i = 0; $i < sizeof($localCurso); $i++) { ?>
                        <option value="<?php echo $localCurso[$i]->id; ?>"><?php echo $localCurso[$i]->texto; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="span5">
                <label>Fun&ccedil;&abreve;o / Miss&abreve;o</label>
                <select class="span12 ddlCursoFuncao" id="select01">
                   <option value="0">Selecione...</option>
                    <?php for ($i = 0; $i < sizeof($cursoFuncao); $i++) { ?>
                        <option value="<?php echo $cursoFuncao[$i]->id; ?>"><?php echo $cursoFuncao[$i]->texto; ?></option>
                    <?php } ?>
                </select>
            </div>  
            <button type="button" class="span2 btn btn-success btnAdicionarCurso" style="margin-top:23px;"><i class="icon-plus-sign icon-white"></i> Adicionar</button>

        </div>
        <hr>

        <table class="table tableDataGrid table-striped table-bordered table-condensed">
            <thead class="header-table">
                <tr>
                    <th width="45%">Local do Curso Enchei-vos</th>
                    <th width="45%">Fun&ccedil;&abreve;o / Miss&abreve;o</th>
                    <th width="10%">A&ccedil;&abreve;o</th>
                </tr>
            </thead>
            
           
            <?php for ($i = 0; $i < sizeof($cursosAssociados); $i++) { ?>
            <tr>
                <td class="nomeCurso"><?php echo $cursosAssociados[$i]->cursoTexto ?></td>
                <td class="funcao"><?php echo $cursosAssociados[$i]->funcaoTexto ?></td>
                <td>
                    <div class="btn btn-mini"><i class="icon-trash btnExcluirCurso"></i></div>
                    <input type="hidden" class="hdnItemJson" value='<?php $helper->JsonStringify($cursosAssociados[$i])?>' />
                    <input type="hidden" class="hdnCursoAssociadoId" value="<?php echo $cursosAssociados[$i]->id ?>" />
                </td>
            </tr>
            <?php } ?>
     
            
            <tr class="template hide">
                <td class="nomeCurso"></td>
                <td class="funcao"></td>
                <td>
                    <div class="btn btn-mini"><i class="icon-trash btnExcluirCurso"></i></div>
                    <input type="hidden" class="hdnItemJson" value='' />
                    <input type="hidden" class="hdnCursoAssociadoId" value="0" />
                </td>
            </tr>
        </table>


        <div class="row-fluid">  
            <div class="span12">
                <div class="pull-right">
                    <a class="btn btn-large btn-warning btnAssociar" href="#" data-toggle="tab"><i class="icon-refresh icon-white"></i> Associar</a>
                </div>
            </div>  	 
        </div>
    </form>
</div>