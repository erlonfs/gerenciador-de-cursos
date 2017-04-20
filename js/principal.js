/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Principal = {
    settings: {
        urls:{
            obterConteudoModal: '',
            excluirParticipante: ''
        }
    },
    
    container: null,
    
    load: function(container, options){   
        if(options)$.extend(Principal.settings, options);
        
        Principal.container = container;        
        Principal.container.delegate('.btnModal', 'click', Principal.abrirModal);                        
        Principal.container.delegate('.btnExcluirParticipante', 'click', Principal.excluirParticipante);
    },  
    
    abrirModal: function(){
        var id = $('.hdnParticipanteId', $(this).closest('div')).val();
               
         $.ajax({
            url: Principal.settings.urls.obterConteudoModal,
            data: {id: id},
            cache: false,
            async: false,
            type: 'get',
            typeData: 'json',
            error: function (XMLHttpRequest, textStatus, erroThrown) {
                console.log('Erro: '+textStatus);
            },
            success: function (response, textStatus, XMLHttpRequest) {
                if (response) {                                                      
                    $('.modalFluid', Principal.container).html(response);                    
                }
            }
        });
        
        alignModal();
                                          
    },
    
    excluirParticipante: function (){
        var container = $(this).closest('tr');
        var participanteId = $('.hdnParticipanteId', container).val() || 0;
        
         $.ajax({
            url: Principal.settings.urls.excluirParticipante,
            data: {id: participanteId},
            cache: false,
            async: false,
            type: 'post',
            typeData: 'json',
            error: function (XMLHttpRequest, textStatus, erroThrown) {
                console.log('Erro: '+textStatus);
            },
            success: function (response, textStatus, XMLHttpRequest) {
                
                
            }
        });
        
    }
    
}