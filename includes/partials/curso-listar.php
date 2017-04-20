<div class="tab-pane <?php echo (!isset($id)) ? 'active' : '' ?>" id="tab2">
    <pre class="titulo">Lista de Cursos</pre>	

    <table class="table table-bordered table-striped fontMaior" id="data-table">
        <thead class="header-table">
            <tr>
                <th width="60%">Curso/Local</th>
                <th width="22%">Cidade</th>
                <th width="20%">Ações</th>
            </tr>
        </thead>
        <tbody>                            
            <?php for ($i = 0; $i < sizeof($cursos); $i++) { ?>
                <tr>
                    <td>
                        <a href="<?php echo Config::$UrlBase.'?url=cursos&id='.$cursos[$i]->getId(); ?>"><?php echo $cursos[$i]->getNomeLocal(); ?></a>
                    </td>
                    <td><?php echo $cursos[$i]->getCidadeNome(); ?></td>
                    <td>
                        <div class="pull-right">
                            <a data-toggle="modal" href="#myModal<?php echo $i; ?>" class="btn btn-mini" title="Ver Perfil"><i class="icon-eye-open"></i> Ver</a>
                            <a href="<?php echo Config::$UrlBase.'?url=cursos&id='.$cursos[$i]->getId(); ?>" class="btn btn-mini" title="Editar Perfil"><i class="icon-pencil"></i> Editar</a>
                        </div>

                        <div id="myModal<?php echo $i; ?>" class="modal hide fade">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2>Visualizar Curso</h3>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nome/Local:</strong> <?php echo $cursos[$i]->getNomeLocal(); ?></p>
                                <p><strong>Endereço:</strong> <?php echo $cursos[$i]->getEndereco(); ?></p>
                                <p><strong>Número:</strong> <?php echo $cursos[$i]->getNumero(); ?></p>
                                <p><strong>Cidade:</strong> <?php echo $cursos[$i]->getCidadeNome(); ?></p>
                                <p><strong>Estado:</strong> <?php echo $cursos[$i]->getEstadoNome(); ?></p>
                                <p><strong>CEP:</strong> <?php echo $cursos[$i]->getCep(); ?></p>
                                <p><strong>Bairro:</strong> <?php echo $cursos[$i]->getBairro(); ?></p>

                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn" data-dismiss="modal" >Close</a>
                                <a href="<?php echo Config::$UrlBase.'pdf/cursoPDF.php?id='.$cursos[$i]->getId(); ?>" class="btn"><i class="icon-file"></i> Gerar PDF</a>
                            </div>
                        </div>
                    </td>                                
                </tr>                                                        
            <?php } ?>
        </tbody>
    </table>
</div>