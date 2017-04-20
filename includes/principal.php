<?php      
    $dataAcessCurso = new CursoDAO();            
    $dataAcessParticipante  = new ParticipanteDAO(); 
    $dataAcessUsuario  = new UsuarioDAO();
    
    $cursos = $dataAcessCurso->getList('where 1 = 1');    
?>

<script type="text/javascript" src="js/principal.js"></script>
<script type="text/javascript">      
       Principal.load($('#container'), {           
           urls: {
               obterConteudoModal: '<?php echo Config::$UrlBase.'actions/helperObterConteudoModalParticipante.php'; ?>'
           }
       });             
</script>
<div class="row-fluid">
    <div class="span12">

        <div class="accordion" id="accordion2">
            
            <?php for($i = 0; $i< sizeof($cursos); $i++)  {?>
            
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle principal" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $cursos[$i]->getId(); ?>">
                        <?php echo $cursos[$i]->getNomeLocal(); ?>
                    </a>
                </div>
                <div id="collapse<?php echo $cursos[$i]->getId(); ?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <table class="table table-bordered table-striped fontMaior">
                            <thead class="header-table">
                                <tr>
                                    <th width="55%">Nome</th>
                                    <th width="22%">Fun&ccedil;&abreve;o / Miss&abreve;o</th>
                                    <th width="23%">A&ccedil;&odblac;es</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <!-- ////////////////Usuarios associados como coordenadores//////////////// -->
                                <?php $usuarios = $dataAcessUsuario->obterUsuarioAssociado($cursos[$i]->getId());                                                                
                                for($j = 0; $j< sizeof($usuarios); $j++)  {?>
                                <tr>
                                    <td>
                                        <a href="#" onclick="javascript:return false;">
                                            Coordenador - <?php echo $usuarios[$j]->getNome(); ?>
                                        </a>
                                    </td>
                                    <td><?php echo $usuarios[$j]->getFuncaoMissao(); ?></td>
                                    <td>
                                        <div class="pull-right">
                                            <input type="hidden" class="hdnUsuarioId" value='<?php echo $usuarios[$j]->getId(); ?>' />
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                <!-- ////////////////Usuarios associados como coordenadores//////////////// -->
                                
                                
                                <?php $participantes = $dataAcessParticipante->obterParticipanteAssociado($cursos[$i]->getId());                                                                
                                for($j = 0; $j< sizeof($participantes); $j++)  {?>
                                <tr>
                                    <td>
                                        <a href="<?php echo Config::$UrlBase . '?url=participantes&id=' . $participantes[$j]->getId(); ?>">
                                            <?php echo $participantes[$j]->getNome(); ?>
                                        </a>
                                    </td>
                                    <td><?php echo $participantes[$j]->getFuncaoMissao(); ?></td>
                                    <td>
                                        <div class="pull-right">
                                            <a data-toggle="modal" href="#myModal" class="btn btn-mini btnModal" title="Ver Perfil"><i class="icon-eye-open"></i> Ver</a>
                                            <a href="<?php echo Config::$UrlBase . '?url=participantes&id=' . $participantes[$j]->getId(); ?>" class="btn btn-mini" title="Editar Perfil"><i class="icon-pencil"></i> Editar</a>
                                            <a href="#" class="btn btn-mini btn-danger" title="Excluir Perfil"><i class=" icon-trash icon-white"></i> Excluir</a>
                                            <input type="hidden" class="hdnParticipanteId" value='<?php echo $participantes[$j]->getId(); ?>' />
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>                                                                                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
            <?php } ?>            
        </div>
    </div>                     
</div> 