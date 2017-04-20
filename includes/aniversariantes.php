<?php
    $dataAcessObjectAniversariante = new ParticipanteDAO();
    
    $aniversariante = $dataAcessObjectAniversariante->getList('where MONTH(t.data_nasc) = MONTH(NOW())  
                                                                and DAY(t.data_nasc) >=  DAY(NOW()) 
                                                                and WEEK(t.data_nasc) = WEEK(NOW())')
?>

<!-- ///////// Barra Lateral -->
<div class="barraLateral" id="containerAniversariante">
    <div class="titBarraLateral"> <a title="Clique para Expandir" class="btBarraLateral header-niver"><i class="icon-chevron-left icon-white"></i>  Aniversariantes da Semana <span class="fecharNiver">(clique aqui para fechar a aba) <i class="icon-chevron-right icon-white"></i></span></a>  </div> 
    <div style="padding-top:5px; padding-left:25px; padding-right:25px; padding-bottom:7px;"> 
        <table class="table table-striped table-bordered table-condensed bgtable">
            <thead>
                <tr>
                    <th width="50%">Nome</th>
                    <th width="30%">Data</th>
                    <th width="20%">Dados</th>
                </tr>
            </thead>
            <?php for($i = 0; $i < sizeof($aniversariante); $i++){?>
            <tr>
                <td><?php echo $aniversariante[$i]->getNome(); ?></td>
                <td><?php echo $aniversariante[$i]->getDataNasc(2); ?></td>
                <input type="hidden" class="hdnAniversarianteId" value='<?php echo $aniversariante[$i]->getId(); ?>' />
                <td><a data-toggle="modal" href="#myModal" class="btn btn-mini btnModalAniversariante"><i class="icon-eye-open"></i> Ver</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div> 
<!-- ///////// Barra Lateral -->