{literal}
    <script type="text/javascript">
        var  news_id = 63362;
        function update_flag()
        {
             $.ajax({
               url : "/" ,
               type : "GET",
               data : {
                   act : "NewsDeletedAction",
                   action : "editnews",
                   id : news_id
               },
               success : function(data){
                   window.localtion = {/literal}{$GUrl.Base}{literal};
               },
               error : function(){
                    alert('Request not found!');               
               }
            });
        }
        setInterval(function(){   
            update_flag();
        },540000);        
    </script>    
    
{/literal}
