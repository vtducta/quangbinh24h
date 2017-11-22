$(function() {
    $( ".draggable" ).draggable({ 
        revert: true,
        revertDuration: 100  
    });
    $( ".droppable" ).droppable({
        accept: '.draggable', 
        drop: function( event, ui ) {
            $( this ).addClass( "drop-highlight" );
            var obj_view = $(this).children('.preview_drag'); 
            var obj_original = ui.helper;                                 
            var id = ui.helper.attr("id").replace('news_','');           
            var view = $(this).attr("id");                                 
            var reg = /^[0-9]*$/;
            if(view=='cat_homeview' || view=='chuyen_muc_noi_bat')
            {                
                if((reg.test(id)))
                {
                    alert('Vui lòng chọn  chuyên mục kéo  vào ! không được phép kéo bài viết vào!');
                    return false;     
                }               
            }else{
                if(!(reg.test(id)))     
                {
                    alert('Vui lòng chọn  bài viết kéo  vào ! không được phép kéo chuyên mục vào!');
                    return false;
                }
            }
            if(!(reg.test(id)))     
            {
                id = id.replace('cat_','');
            }
            $.ajax({
                type : "GET",
                url : "/",
                data : {act:"DetectedView", id : id,view : view},
                success : function(html){                    
                    obj_view.html(html); 
                    if (confirm("Bạn có muốn muốn hiển thị tin vào vị trí này ?")) { 
                        $.ajax({                                    
                            type : "GET",
                            url : "/",
                            data : {act : "ProcessNews" ,id :id , view : view},
                            success : function(html)
                            {
                                alert('Update thành công!');
                                return false;
                            }
                        });  
                    }                              
                }
            }); 
        }

    });
}); 
function deleted_new(id_new)
{                                            
    $("li").click(function () {
        if (confirm("Hạ tin khỏi vị trí này?"))
            {
            var view = $(this).attr("id");
            var obj_view = $(this).children('.preview_drag');
            $.ajax({
                type : "GET",
                url : '/',
                data : {act:"DeletedNews", id : id_new,view : view},
                success : function(html)
                {
                    obj_view.html('');                                                                                                
                    alert('Hạ tin bài thành công!');
                    $("li").unbind('click');
                }
            });                                                
        }
        else
            {
            $("li").unbind('click');
        }
    });            
} 