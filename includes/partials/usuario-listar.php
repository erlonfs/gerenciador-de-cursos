<div class="tab-pane <?php echo (!isset($associar) && !isset($id)) ? 'active' : '' ?>" id="tab3">
    <pre class="titulo">Lista de Usu&aacute;rios <a href="#" class="btn btn-mini btn-uteis pull-right"><i class="icon-file"></i> Gerar PDF</a></pre>	<br />
    <div class="titulo"> Buscar/Filtrar <i class="icon-search"></i></div>
    <div class="row-fluid"></div>



<table class="table table-bordered table-striped fontMaior" id="data-table">
    <thead class="header-table">
        <tr>
            <th width="55%">Nome</th>
            <th width="22%">Fun&ccedil;&abreve;o / Miss&abreve;o</th>
            <th width="23%">A&ccedil;&odblac;es</th>
        </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i <sizeof($usuarios); $i++){ ?>
        <tr>
            <td><a href="<?php echo Config::$UrlBase.'?url=usuarios&id='.$usuarios[$i]->getId(); ?>"><?php echo $usuarios[$i]->getNome();?></a></td>
            <td> <?php                    
                        $strCursos = '';
                        $cursosDoUsuario = $dataAcess->obterCursoAssociado($usuarios[$i]->getId());
                        for ($j = 0; $j < sizeof($cursosDoUsuario); $j++) { 
                            $strCursos .= $cursosDoUsuario[$j]->funcaoTexto.'; '; 
                        }
                        
                        echo $strCursos;
          ?></td>
            <td>
                <div class="pull-right"><a data-toggle="modal" href="#myModal<?php echo $i; ?>" class="btn btn-mini" title="Ver Perfil"><i class="icon-eye-open"></i> Ver</a>
                    <a class="btn btn-mini" href="<?php echo Config::$UrlBase.'?url=usuarios&id='.$usuarios[$i]->getId(); ?>" ><i class="icon-pencil"></i> Editar</a>
                    <a class="btn btn-mini" href="<?php echo Config::$UrlBase.'?url=usuarios&associar='.$usuarios[$i]->getId(); ?>"><i class="icon-refresh"></i> Associar</a>
                </div>
                
                <div id="myModal<?php echo $i; ?>" class="modal hide fade">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2>Visualizar Usu&aacute;rio</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Dados</th>
                                    <th>Fornecidos</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Nome:</td>
                                <td><?php echo $usuarios[$i]->getNome() ?></td>
                            </tr>
                            <tr>
                                <td>Função / Missão:</td>
                                <td>Servo Auxiliar</td>
                            </tr>
                            <tr>
                                <td>Local/Curso:</td>
                                <td>Paroquia Sao Goncalo</td>
                            </tr>
                            <tr>
                                <td>Cidade:</td>
                                <td><?php echo $usuarios[$i]->getCidade(); ?></td>
                            </tr>
                            <tr>
                                <td>Telefone:</td>
                                <td><?php echo $usuarios[$i]->getTelefone(); ?></td>
                            </tr>
                            <tr>
                                <td>Celular:</td>
                                <td><?php echo $usuarios[$i]->getNome(); ?></td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td><?php echo $usuarios[$i]->getNome(); ?></td>
                            </tr>

                        </table>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal" >Close</a>
                        <a href="<?php //echo Config::$UrlBase.'pdf/cursoPDF.php?id='.$cursos[$i]->getId(); ?>" class="btn"><i class="icon-file"></i> Gerar PDF</a>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>