$(document).ready(function(){     
    list_new();
    $('.feature_cat').change(function() {                                    
        var cat_id = $(this).attr('value');                                                
        if(cat_id!=0)
        {
            $('.cat').attr('id', 'cat_'+cat_id);                                                
            $('#show').css('display','block');    
        }
        else
        {
            $('#show').css('display','none');    
        }        
     });
     $('.selected_cat').change(function(){
        var cat_id = $(this).attr('value');                                     
        var Container = $('#news_category');    
        if(cat_id!=0)
        {
            category_id = cat_id;        
            $.ajax({        
                type : "GET",
                url : "/",
                data : {act:"ListNewsCategory",id : cat_id},
                success : function(html){
                    Container.html(html);
                }
            });
            list_new();                                          
        }
     });     
     $('.selected_cat1').change(function(){     
         var cat_id = $(this).attr('value');                                     
         if(cat_id!=0)
        {
            category_id = cat_id;                  
            list_new();                                          
        }
         
     });
     $('.select_event').change(function() {                                    
        var cat_id = $(this).attr('value');                                                
        if(cat_id !=0)
        {
            $('.event').attr('id', 'news_'+cat_id);                                                
            $('#show_event').css('display','block');    
        }
        else
        {
            $('#show_event').css('display','none');        
        } 
        
     });
    
});

function create_feature_home(id)
{   
    if(id==1)
    {
        var title_name = $("#feature_home1").val();            
    }else
    {
        var title_name = $("#feature_home2").val();        
    }    
    if(title_name == '')
    {
        alert('Vui lòng nhập tên tiêu điểm !');
        return false;
    }
    $.ajax({        
                type : "POST",
                url : "/",
                data : {act:"NameFeature",title : title_name ,option : id},
                success : function(html){
                    alert('Tạo tin thành công');
                }
      });
}
function list_new()
{
    var Container = $('#list_new');     
    $.ajax({        
            type : "GET",
            url : "/",
            data : {act:"ListNews",id : category_id},
            success : function(html){
                Container.html(html);
            }
        }); 
}
function tim_kiem()
{
    var keyword = $('input[name=keyword]').val();    
    var Container = $('#list_new');    
    if(keyword =='')            
    {
        alert('Vui lòng nhập từ khóa !');
        return false;
    }                                                                                                     
    $.ajax({        
            type : "GET",
            url : "/",
            data : {act:"Search",keyword :keyword , id : category_id},
            success : function(html){                                    
                Container.html(html);
            }
    }); 
}                    
