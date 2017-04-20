/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Aniversariante = {
    settings: {
        urls:{
            obterConteudoModal: ''
        }
    },
    
    container: null,
    
    load: function(container){        
        Aniversariante.container = container;
        
        Aniversariante.container.delegate('.btnModalAniversariante', 'click', Aniversariante.abrirModal); 
    },
    
    
    abrirModal: function(){
        var id = $('.hdnAniversarianteId', $(this).closest('div')).val();
               
        $.ajax({
            url: Aniversariante.settings.urls.obterConteudoModal,
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
                    $('#myModal').html(response);                    
                }
            }
        });
        
        alignModal();
                                          
    }     
}
