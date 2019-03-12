
// *************
 function loginAction(dataAjaxL){
var html="";
   if(dataAjaxL['res']==false){
      html='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
            '<strong>Error!</strong>'+
          dataAjaxL['msg']+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
              '<span class="fa fa-times"></span>'+
                '</button>'+
          '</div>';
          $("#msgLoginAction").html(html);
   }

 }

// *************
