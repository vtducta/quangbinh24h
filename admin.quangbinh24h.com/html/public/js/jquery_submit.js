function block_ui()
{
    $.blockUI({ message: '<h3><img src="/images/busy.gif" />processing your request.  Please be wait!</h3>' }); 
    setTimeout($.unblockUI, 7000); 
}
jQuery(document).ready(function(){
    $("#xuatban").click(function(event) {
        event.preventDefault();  
        if($.trim($('#journalist-input').val())==''){
            alert("Xin hãy chọn tác giả bài viết.");
            return false;
        }
        if($("#source_id").val()<1){
            alert('Xin hãy chọn nguồn bài viết');
            return false;
        }                           
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked =\"checked\" value=\"1\" name=\"public\" class=\"ibutton\" \/>";                                
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#AddNews').submit();                        
        block_ui();
    });
    $("#draft").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked =\"checked\" value=\"2\" name=\"public\" class=\"ibutton\" \/>";                                
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#AddNews').submit();
        block_ui();
    });
    $("#sendnews").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked=\"checked\" value=\"3\" name=\"status\" class=\"ibutton\" \/>";                                
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#AddNews').submit();
        block_ui();
    });
    $("#btv_draft").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked=\"checked\" value=\"2\" name=\"status\" class=\"ibutton\" \/>";                                
        html += "<input type=\"radio\" id=\"inlineCheckbox4\" checked=\"checked\" value=\"2\" name=\"draft\" class=\"ibutton\" \/>";                                
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#AddNews').submit();
        block_ui(); 
    });
    
    $("#btv_save_news").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked=\"checked\" value=\"2\" name=\"status\" class=\"ibutton\" \/>";                                
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#AddNews').submit();
        block_ui(); 
    });    
    
    $("#btv_return").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked=\"checked\" value=\"-1\" name=\"status\" class=\"ibutton\" \/>";                                
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#AddNews').submit();
        block_ui(); 
    });    
    $("#ad_save").click(function(event) {
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked =\"checked\" value=\"-2\" name=\"public\" class=\"ibutton\" \/>";                                                        
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#editNews').submit();
        block_ui();
    });
    
    $("#update").click(function(event) {
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked =\"checked\" value=\"1\" name=\"public\" class=\"ibutton\" \/>";
        
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#editNews').submit();
        block_ui();
    });
    
    $("#deleted").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked =\"checked\" value=\"0\" name=\"public\" class=\"ibutton\" \/>";
        
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#editNews').submit();                        
        block_ui();
    });
    
    $("#return").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked =\"checked\" value=\"-1\" name=\"public\" class=\"ibutton\" \/>";                                
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#editNews').submit();                            
        block_ui();
    })    
    
    $("#ctv_send").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked =\"checked\" value=\"2\" name=\"status\" class=\"ibutton\" \/>";
        $("#status_news").html('');
        $("#status_news").html(html);
        $('#AddNews').submit();
        block_ui();
    });    
    
    $("#ctv_draft").click(function(event){
        event.preventDefault();                             
        html = "<input type=\"radio\" id=\"inlineCheckbox4\" checked =\"checked\" value=\"1\" name=\"status\" class=\"ibutton\" \/>";
        $("#status_news").html('');
        $("#status_news").html(html);                                    
        $('#AddNews').submit();
        block_ui();
    });
    $("#addvideo").click(function(event) {
        event.preventDefault();                             
        $('#AddVideo').submit();                        
        block_ui();
    });
});
