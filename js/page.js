/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Page = {
    settings: {
        urls:{
            obterMunicipios: '',
            atualizarSemestre: '',
            gerenciarExibirMensagem: ''
        }
    },
    
    container: null,
    
    load: function(container){        
        Page.container = container;
        
        Page.container.delegate('.ddlEstados', 'change', Page.gerenciarEstados);                        
        $(Page.container).closest('body').delegate('.linkFechar', 'click', Page.gerenciarExibirMensagem);
        $(Page.container).closest('body').delegate('.ddlSemestre', 'change', Page.onChangeSemestre);
        
    },
   
   onChangeSemestre: function(){
       var container = $(Page.container).closest('body');
       var semestre = $('.ddlSemestre :selected', container).val() || 0;
       
       var desejaMudar = confirm('Tem certeza que deseja trocar de semestre?\n\nObs: Isso podera alterar a forma de visualizar os dados cadastrados.');
              
       if(desejaMudar && semestre != 0){
        var url = document.URL;

        $.ajax({
            url: Page.settings.urls.atualizarSemestre,
            data: {semestre: semestre, url: url},
            cache: false,
            async: false,
            type: 'post',
            typeData: 'json',
            error: function (XMLHttpRequest, textStatus, erroThrown) {
                console.log('Erro: '+textStatus);
            },
            success: function (response, textStatus, XMLHttpRequest) {  
                window.location.reload();
            }
        });
       }        
    },
        
    gerenciarEstados: function(){
        var estado = $(this).val();
        var container = $(this).closest('.row-fluid');
       
        $.ajax({
            url: Page.settings.urls.obterMunicipios,
            data: {
                estado: estado
            },
            cache: false,
            async: false,
            type: 'get',
            typeData: 'json',
            contentType: 'application/json; charset=utf-8',
            error: function (XMLHttpRequest, textStatus, erroThrown) {
                console.log('Erro: '+textStatus);
            },
            success: function (response, textStatus, XMLHttpRequest) {
                if (response) {                    
                    municipios = JSON.parse(response);                        
                    var dados = [];  
                    $(municipios).each(function(i, item){                                                                          
                       dados.push({ Id: item.id, Nome: item.nome });                                                                     
                    });
                    
                    Page.carregarDropDownList('ddlMunicipios', container, dados)                    
                }
            }
        });             
    },
    
    gerenciarExibirMensagem: function(){
      var container = $(Page.container).closest('body');  
                      
      $.ajax({
          url: Page.settings.urls.gerenciarExibirMensagem,
          data: null,
          cache: false,
          async: false,
          type: 'get',
          typeData: 'json',
          contentType: 'application/json; charset=utf-8',
          error: function (XMLHttpRequest, textStatus, erroThrown) {
               console.log('Erro: '+textStatus);
          },
          success: function (response, textStatus, XMLHttpRequest) {
               window.location.reload();
          }
       });  
       
       $(this).closest('.boxMsg').addClass('hide'); 
       return false;
        
    },
    
    carregarDropDownList: function(classe, container, dados){       
        var html = '<option value="0">Selecione...</<option>';
        
        $(dados).each(function(i, item){            
            html += '<option value="'+item.Id+'">'+item.Nome+'</<option>';                        
        });
               
        $('.'+classe, container).html(html);        
    }
    
}
