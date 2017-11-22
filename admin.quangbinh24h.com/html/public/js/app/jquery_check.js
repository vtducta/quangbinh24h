jQuery(document).ready(function(){
        $.ajax({
           url :  "/",
           type : "GET",
           data : {act : "CheckLogin"},
           success : function(data)
           {
               if(data==0)
               {
                   window.location = 'http://admin.danang24h.vn/?act=login'
               }
           },
           error : function()
           {
               
           }
        });
});