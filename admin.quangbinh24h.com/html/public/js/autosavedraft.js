 $(document).ready(function(){  
      function autoSave()  
      {  
           var title = $('#id_title').val();  
           var short_desc = $('#short_desc').val();  
           //var content = $('#mceEditor').val();  
           var content = tinymce.get('mceEditor').getContent();
           if(title != '')  
           {  
                $.ajax({  
                     url:"http://admincms.nguoiduatin.vn/?act=AutoSave",  
                     method:"POST",  
                     data:{title:title, short_desc:short_desc, content:content},  
                     dataType:"text",  
                });  
           }            
      }  
      setInterval(function(){   
           autoSave();   
           }, 5*60000);  
 }); 