<div class="tab-pane <?php echo (!isset($associar) && !isset($id)) ? 'active' : '' ?>" id="tab3">
    <pre class="titulo">Lista dos participantes &nbsp; <a href="<?php echo Config::$UrlBase.'pdf/participantePDF.php'; ?>" class="btn btn-mini btn-uteis pull-right"><i class="icon-file"></i> Gerar PDF</a></pre><br />   
    <div class="titulo"> Buscar/Filtrar <i class="icon-search"></i></div>
    <div class="row-fluid"></div>
    <br/>

    <table class="table table-bordered table-striped fontMaior" id="data-table">
        <thead class="header-table">
            <tr>
                <th width="55%">Nome</th>
                <th width="22%">Fun&ccedil;&abreve;o / Miss&abreve;o</th>
                <th width="23%">A&ccedil;c&odblac;es</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < sizeof($participantes); $i++) { ?>
                <tr>
                    <td><a href="<?php echo Config::$UrlBase . '?url=participantes&id=' . $participantes[$i]->getId(); ?>"><?php echo $participantes[$i]->getNome(); ?></a></td>
                    <td> <?php echo $participantes[$i]->getFuncaoMissao();?></td>
                    <td>
                        <div class="pull-right">
                            <a data-toggle="modal" href="#myModal" class="btn btn-mini btnModal" title="Ver Perfil"><i class="icon-eye-open"></i> Ver</a>
                            <a href="<?php echo Config::$UrlBase . '?url=participantes&id=' . $participantes[$i]->getId(); ?>" class="btn btn-mini" title="Editar Perfil"><i class="icon-pencil"></i> Editar</a>
                            <a href="<?php echo Config::$UrlBase . '?url=participantes&associar=' . $participantes[$i]->getId(); ?>" class="btn btn-mini" title="Associar Perfil"><i class=" icon-refresh"></i> Associar</a>
                            <input type="hidden" class="hdnParticipanteId" value='<?php echo $participantes[$i]->getId(); ?>' />
                        </div>
                    </td>
                </tr>
            <?php } ?>       
        </tbody>
    </table> 
</div>