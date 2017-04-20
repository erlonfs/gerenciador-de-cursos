/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Curso = {
    settings: {
        urls:{
            salvar: '',
            associar: '',
            redirect: ''
        }
    },
    
    container: null,
    
    load: function(container, options){   
        if(options)$.extend(Curso.settings, options);
        
        Curso.container = container;        
        Curso.container.delegate('.btnSalvar', 'click', Curso.salvar);                        
    },

    obter: function(){
        var container = Curso.container;
        
        var obj = {
            id: $('.hdnId', container).val() || 0,
            nome_local: $('.txtCursoLocal', container).val() || '',
            endereco: $('.txtEndereco', container).val() || '',
            numero: $('.txtNumero', container).val() || '',
            bairro: $('.txtBairro', container).val() || '',
            cep: $('.txtCep', container).val() || '',
            cidade: $('.ddlMunicipios :selected', container).val() || 0,
            estado: $('.ddlEstados :selected', container).val() || 0
        }
 
        return obj;
    },
    
    validar: function(obj){
        var msg = '';
        
        if(obj.nome_local == ''){
            msg += 'Curso/Local é obrigatório\n';
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
        
        if(obj.estado == 0){
            msg += 'Estado é obrigatório\n';
        }
        
        if(obj.cidade == 0){
            msg += 'Cidade é obrigatório\n';
        }
        
        if(msg != ''){
            alert('-- -- -- -- Mensagem do Sistema -- -- -- -- \n\n'+msg);            
            return;
        }
        
        return true;
    },
    
    
    salvar: function(){        
        var container = Curso.container;
        
        var obj = Curso.obter();
        
        if(Curso.validar(obj)){        
            $.ajax({
                url: Curso.settings.urls.salvar,
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
                    window.location.href = Curso.settings.urls.redirect;
                }
            });        
        }        
    }    
}
    