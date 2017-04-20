/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


Participante = {
    settings: {
        urls:{
            salvar: '',
            associar: '',
            redirect: '',
            obterPorCpfCnpj: '',
            base: ''
        }
    },
    
    container: null,
    
    load: function(container, options){   
        if(options)$.extend(Participante.settings, options);
        
        Participante.container = container;        
        Participante.container.delegate('.btnSalvar', 'click', Participante.salvar);  
        Participante.container.delegate('.btnModal', 'click', Participante.abrirModal); 
        Participante.container.delegate('.btnAdicionarCurso', 'click', Participante.adicionarCurso);
        Participante.container.delegate('.btnExcluirCurso', 'click', Participante.excluirCurso);
        Participante.container.delegate('.btnAssociar', 'click', Participante.associar);
        Participante.container.delegate('.btnVerificarCpfCnpj', 'click', Participante.verificarCpfCnpj);
        Participante.container.delegate('.txtCpfCnpj', 'change', Participante.verificarCpfCnpj);
        Participante.container.delegate('.btAba', 'click', Participante.gerenciarSetarDisableAll);
                                
    },
    
    gerenciarSetarDisableAll: function(){
       Participante.setarDisableAll(Participante.obter().id == 0);        
    },
    
    setarDisableAll: function(flag){        
        if(flag){
            $('.disable', Participante.container).each(function(i, item){            
                $(item).attr('disabled', 'disabled');
            });
            
            $('.btnSalvar', Participante.container).addClass('hide');            
            return;
        }
        
        $('.disable', Participante.container).each(function(i, item){            
            $(item).removeAttr('disabled', 'disabled');
        });

        $('.btnSalvar', Participante.container).removeClass('hide');       
    },
    
    
    verificarCpfCnpj: function(){
        var container = Participante.container;
        var cpf_cnpj = ($('.txtCpfCnpj', container).val() || '').replace(/[^\d]+/g,'');
        
        var msg = '';
        
        if(cpf_cnpj == ''){
            msg = 'Cpf é obrigatório\n';
        }else{
            if(!Participante.validarCPF(cpf_cnpj)){
                msg = 'Cpf é inválido\n';
            }            
        }
                
        if(msg != ''){
            Participante.setarDisableAll(true);
            alert('-- -- -- -- Mensagem do Sistema -- -- -- -- \n\n'+msg);  
            return;
        }
        
        Participante.setarDisableAll(false);
        
        
        $.ajax({
            url: Participante.settings.urls.obterPorCpfCnpj,
            data: {CpjCnpj: cpf_cnpj},
            cache: false,
            async: false,
            type: 'post',
            typeData: 'json',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            error: function (XMLHttpRequest, textStatus, erroThrown) {
                console.log('Erro: '+textStatus);
            },
            success: function (response, textStatus, XMLHttpRequest) {
                if(response){           
                    var id = JSON.parse(response).Id || 0;
                    if(id > 0){
                        window.location.href = Participante.settings.urls.base+'?url=participantes&id='+id+'&cpf='+cpf_cnpj;
                    }                    
                }
            }
        });
        
    },
    
    adicionarCurso: function(){
        var container = $(this).closest('tr');
        
        var obj = {
            id: Number($('.hdnCursoAssociadoId', container).val()) || 0,
            participante: $('.hdnParticipanteAssociadoId', Participante.container).val() || 0,
            curso: $('.ddllocalCurso :selected', Participante.container).val() || 0,
            cursoTexto: $('.ddllocalCurso :selected', Participante.container).text() || '',
            funcao: $('.ddlCursoFuncao :selected', Participante.container).val() || 0,
            funcaoTexto: $('.ddlCursoFuncao :selected', Participante.container).text() || ''           
        }
        
        //////////////////Validacoes////////////////////
        
        var msg = '';
        
        if(obj.curso <= 0){
            msg += 'Curso é obrigatório.\n';
        }else{
            //TODO     
        }
                
        if(obj.funcao <= 0){
            msg += 'Função é obrigatória.\n';
        }        
        
        if(msg != ''){
            alert('-- -- -- -- Mensagem do Sistema -- -- -- -- \n\n'+msg);            
            return;
        }
                
        
        
        ////////////////////////////////////////////////
        
        
        var linha = $('.tableDataGrid .template').clone().removeClass('hide').removeClass('template');
        $('.nomeCurso', linha).html(obj.cursoTexto);
        $('.funcao', linha).html(obj.funcaoTexto);
        $('.hdnItemJson', linha).val(JSON.stringify(obj))
        
        $('.tableDataGrid', Participante.container).append(linha);        
    },
    
    excluirCurso: function(){
        $(this).closest('tr').remove();        
    },      
    
    obterCursosAssociados: function(){
        var container = Participante.container;
        var cursos = [];
        
        $('.hdnItemJson', container).each(function(i, item){            
            if($(item).val() != ''){
                var objeto = JSON.parse($(item).val());
                cursos.push(objeto);
            }
        });
        
        return cursos;
        
    },

    obter: function(){
        var container = Participante.container;
        var obj = {
            id: $('.hdnId', container).val() || 0,
            nome: $('.txtNome', container).val() || '',
            cpf_cnpj: ($('.txtCpfCnpj', container).val() || '').replace(/[^\d]+/g,''),
            data_nasc: $('.txtDataNasc', container).val() || '',
            sexo: $('.rbdSexo:checked', container).val() || '',
            endereco: $('.txtEndereco', container).val() || '',
            numero: $('.txtNumero', container).val() || '',
            bairro: $('.txtBairro', container).val() || '',
            cep: $('.txtCep', container).val() || '',
            cidade: $('.ddlMunicipios :selected', container).val() || 0,
            estado: $('.ddlEstados :selected', container).val() || 0,
            complemento: $('.txtComplemento', container).val() || '',
            telefone: $('.txtTelefone', container).val() || '',
            celular1: $('.txtCelular1', container).val() || '',
            celular2: $('.txtCelular2', container).val() || '',
            celular3: $('.txtCelular3', container).val() || '',
            email1: $('.txtEmail1', container).val() || '',
            email2: $('.txtEmail2', container).val() || '',
            nome_mae_responsavel: $('.txtNomeMaeResponsavel', container).val() || '',
            nome_pai_responsavel: $('.txtNomePaiResponsavel', container).val() || '',
            estado_civil: $('.txtEstadoCivil', container).val() || '',
            nome_conjuge: $('.txtNomeConjuge', container).val() || '',
            profissao: $('.txtProfissao', container).val() || '',
            instituicao_nome: $('.txtInstituicaoNome', container).val() || '',
            instituicao_endereco: $('.txtInstituicaoEndereco', container).val() || '',
            instituicao_numero: $('.txtInstituicaoNumero', container).val() || '',
            instituicao_bairro: $('.txtInstituicaoBairro', container).val() || '',
            instituicao_cep: $('.txtInstituicaoCep', container).val() || '',
            instituicao_cidade: $('.ddlInstituicaoMunicipios :selected', container).val() || 0,
            instituicao_estado: $('.ddlInstituicaoEstados :selected', container).val() || 0,
            info_sacramento: 0,
            setor: 0,
            veiculo: 0,
            observacoes: $('.txtObservacoes', container).val() || '',
            detentor: 0            
        }

        $('.ckbSacramento', container).each(function(i, item){          
            if($(item).attr("checked") == "checked"){
                obj.info_sacramento += parseInt($(item).val());              
            }          
        });
       
        $('.ckbSetor', container).each(function(i, item){          
            if($(item).attr("checked") == "checked"){
                obj.setor += parseInt($(item).val());              
            }          
        });
       
        $('.ckbVeiculo', container).each(function(i, item){          
            if($(item).attr("checked") == "checked"){
                obj.veiculo += parseInt($(item).val());              
            }          
        });
                
        return obj;
        
    },
    
    validarCPF: function (cpf) {
 
        cpf = cpf.replace(/[^\d]+/g,'');

        if(cpf == '') return false;

        // Elimina CPFs invalidos conhecidos
        if (cpf.length != 11 || 
            cpf == "00000000000" || 
            cpf == "11111111111" || 
            cpf == "22222222222" || 
            cpf == "33333333333" || 
            cpf == "44444444444" || 
            cpf == "55555555555" || 
            cpf == "66666666666" || 
            cpf == "77777777777" || 
            cpf == "88888888888" || 
            cpf == "99999999999")
            return false;

        // Valida 1o digito
        var add = 0;
        for (var i=0; i < 9; i ++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        var rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;

        // Valida 2o digito
        add = 0;
        for (var i = 0; i < 10; i ++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;

        return true;
    },
    
    validar: function(obj){
        var msg = '';
        
        if(obj.nome == ''){
            msg += 'Nome é obrigatório\n';
        }
        
        if(obj.cpf_cnpj == ''){
            msg += 'Cpf é obrigatório\n';
        }else{
            if(!Participante.validarCPF(obj.cpf_cnpj)){
                msg += 'Cpf é inválido\n';
            }            
        }
        
        if(obj.data_nasc == ''){
            msg += 'Data de nascimento é obrigatória\n';
        }
        
        if(obj.sexo == ''){
            msg += 'Sexo é obrigatório\n';
        }
        
        if(obj.endereco == ''){
            msg += 'Endereço é obrigatório\n';
        }
        
        if(obj.numero == ''){
            msg += 'Número é obrigatório\n';
        }
        
        if(obj.bairro == ''){
            msg += 'Bairro é obrigatório\n';
        }
        
        if(obj.cep == ''){
            msg += 'CEP é obrigatório\n';
        }
        
        if(obj.cidade == 0){
            msg += 'Cidade é obrigatório\n';
        }
        
        if(obj.estado == 0){
            msg += 'Estado é obrigatório\n';
        }
        
        if(obj.telefone == ''){
            msg += 'Telefone é obrigatório\n';
        }
        
        if(obj.celular1 == ''){
            msg += 'Celular1 é obrigatório\n';
        }
        
        if(obj.email1 == ''){
            msg += 'Email1 é obrigatório\n';
        }
        
        
        if(msg != ''){
            alert('-- -- -- -- Mensagem do Sistema -- -- -- -- \n\n'+msg);            
            return;
        }
        
        return true;        
    },
    
    validarAssociar: function(obj){
        var msg = '';
        
        if(obj.length <= 0){
            msg += 'É necessario associar pelo menos um curso.\n';
        }
        
        if(msg != ''){
            alert('-- -- -- -- Mensagem do Sistema -- -- -- -- \n\n'+msg);            
            return;
        }
        
        
        return true;
        
    },
    
    salvar: function(){        
        var container = Participante.container;
        
        var obj = Participante.obter();
        
        if(Participante.validar(obj)){        
            $.ajax({
                url: Participante.settings.urls.salvar,
                data: obj,
                cache: false,
                async: false,
                type: 'post',
                typeData: 'json',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (XMLHttpRequest, textStatus, erroThrown) {
                    console.log('Erro: '+textStatus);
                },
                success: function (response, textStatus, XMLHttpRequest) {
                    window.location.href = Participante.settings.urls.redirect;
                }
            });        
        }        
    },
    
    associar: function(){        
        var container = Participante.container;
                
        var obj = Participante.obterCursosAssociados();
                        
        if(Participante.validarAssociar(obj)){        
            $.ajax({
                url: Participante.settings.urls.associar,
                data: {cursos: obj},
                cache: false,
                async: false,
                type: 'post',
                typeData: 'json',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                error: function (XMLHttpRequest, textStatus, erroThrown) {
                    console.log('Erro: '+textStatus);
                },
                success: function (response, textStatus, XMLHttpRequest) {
                    window.location.href = Participante.settings.urls.redirect;
                }
            });        
        }        
    },      
    
    abrirModal: function(){
        var id = $('.hdnParticipanteId', $(this).closest('div')).val();
        $.ajax({
            url: Participante.settings.urls.obterConteudoModal,
            data: {
                id: id
            },
            cache: false,
            async: false,
            type: 'get',
            typeData: 'json',
            error: function (XMLHttpRequest, textStatus, erroThrown) {
                console.log('Erro: '+textStatus);
            },
            success: function (response, textStatus, XMLHttpRequest) {
                if (response) {                                                      
                    $('.modalFluid', Participante.container).html(response);                    
                }
            }
        });
        
        alignModal();
                                          
    }
}