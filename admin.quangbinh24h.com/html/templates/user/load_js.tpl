<script type="text/javascript">
         $(document).ready(function(){
             $("#groupname").change(function(){
                if($(this).val() ==4)
                {
                   $("#category").hide();
                }else{
                    $("#category").show();
                }
             });
             if($( "#groupname option:selected" ).val()==4)
             {
                 $("#category").hide();
             }else{
                 $("#category").show();
             }

         });
</script>