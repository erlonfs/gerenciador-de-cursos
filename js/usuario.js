/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Usuario = {
    settings: {
        urls:{
            salvar: '',
            associar: '',
            redirect: ''
        }
    },
    
    container: null,
    
    load: function(container, options){   
        if(options)$.extend(Usuario.settings, options);
        
        Usuario.container = container;        
        Usuario.container.delegate('.btnSalvar', 'click', Usuario.salvar);   
        Usuario.container.delegate('.btnAdicionarCurso', 'click', Usuario.adicionarCurso);
        Usuario.container.delegate('.btnExcluirCurso', 'click', Usuario.excluirCurso);
        Usuario.container.delegate('.btnAssociar', 'click', Usuario.associar);
    },
    
    adicionarCurso: function(){
        var container = $(this).closest('tr');
        
        var obj = {
            id: Number($('.hdnCursoAssociadoId', container).val()) || 0,
            usuario: $('.hdnUsuarioAssociadoId', Usuario.container).val() || 0,
            curso: $('.ddllocalCurso :selected', Usuario.container).val() || 0,
            cursoTexto: $('.ddllocalCurso :selected', Usuario.container).text() || '',
            funcao: $('.ddlCursoFuncao :selected', Usuario.container).val() || 0,
            funcaoTexto: $('.ddlCursoFuncao :selected', Usuario.container).text() || ''           
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
        
        $('.tableDataGrid', Usuario.container).append(linha);        
    },
    
    excluirCurso: function(){
        $(this).closest('tr').remove();        
    },      
    
    obterCursosAssociados: function(){
        var container = Usuario.container;
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
        var container = Usuario.container;
        
        var obj = {
            id: $('.hdnId', container).val() || 0,
            nome: $('.txtNome', container).val() || '',
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
            login: $('.txtLogin', container).val() || '',
            senha: $('.txtSenha', container).val() || '',
            confirmar_senha: $('.txtConfirmarSenha', container).val() || ''
        }
 
        return obj;
    },
    
    validar: function(obj){
        var msg = '';
        
        if(obj.nome == ''){
            msg += 'Nome é obrigatório\n';
        }           
        
        if(obj.endereco == ''){
            msg += 'Endereço é obrigatório\n';
        }
        
        if(obj.sexo == ''){
            msg += 'Sexo é obrigatório\n';
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
        
        if(obj.estado == 0){
            msg += 'Estado é obrigatório\n';
        }
        
        if(obj.cidade == 0){
            msg += 'Cidade é obrigatório\n';
        }
        
        if(obj.telefone == 0){
            msg += 'Telefone é obrigatório\n';
        }
        
        if(obj.celular1 == 0){
            msg += 'Celular1 é obrigatório\n';
        }
        
        if(obj.email1 == 0){
            msg += 'Email1 é obrigatório\n';
        }        
        
        if(obj.login == ''){
            msg += 'Login é obrigatório\n';
        }
        if(obj.senha == ''){
            msg += 'Senha é obrigatório\n';
        }
        
        if(obj.confirmar_senha == ''){
            msg += 'Confirmar Senha é obrigatório\n';
        }else{
            if(obj.senha != '' && obj.confirmar_senha != obj.senha){
                msg += 'Senha está incorreta. Confirme sua senha corretamente.\n';
            }
        }       
        
        
        if(msg != ''){
            alert(unescape('-- -- -- -- Mensagem do Sistema -- -- -- -- \n\n'+msg));            
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
        var container = Usuario.container;
        
        var obj = Usuario.obter();
        
        if(Usuario.validar(obj)){        
            $.ajax({
                url: Usuario.settings.urls.salvar,
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
                    window.location.href = Usuario.settings.urls.redirect;                                                        
                }
            });        
        }        
    },   
    
    associar: function(){        
        var container = Usuario.container;
                
        var obj = Usuario.obterCursosAssociados();
                        
        if(Usuario.validarAssociar(obj)){        
            $.ajax({
                url: Usuario.settings.urls.associar,
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
                    window.location.href = Usuario.settings.urls.redirect;
                }
            });        
        }        
    }
}
    