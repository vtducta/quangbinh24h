$(document).ready(function(){
           get_info_user();
           get_menu_user(); 
           get_static_news();
           count_news();
});
function get_info_user()
{
    $.ajax({
        url : '/',
        type : "GET",
        dataType : 'html',
        data : {
            act  : 'Profile'            
        },
        success : function(data)
        {
            $('#userinfo').empty();
            $('#userinfo').html(data).fadeIn("fast");
        },
        error : function()
        {            
        }
        
    });
}
function count_news()
{
    $.ajax({
        url : '/',
        type : "GET",
        dataType : 'html',
        data : {
            act  : 'CountNews'            
        },
        success : function(data)
        {
            $('#count_news').empty();
            $('#count_news').html(data).fadeIn("fast");
        },
        error : function()
        {            
        }
        
    });
}
function get_menu_user()
{
    $.ajax({
        url : '/',
        type : "GET",
        dataType : 'html',
        data : {
            act  : 'Menu'            
        },
        success : function(data)
        {
            $('#menunews').empty();
            $('#menunews').html(data).fadeIn("fast");
        },
        error : function()
        {            
        }
        
    });
}
function get_static_news()
{
    $.ajax({
        url : '/',
        type : "GET",
        dataType : 'html',
        data : {
            act  : 'StaticNews'            
        },
        success : function(data)
        {
            $('#static_news').empty();
            $('#static_news').html(data).fadeIn("fast");
        },
        error : function()
        {            
        }
        
    });
}
function timkiem()
{
    var key=$('#keyword').val();
    if(typeof(key) === "undefined" || key=='')
        {
        alert('Vui lòng nhập vào từ khóa!');
        return false;
    }
    window.location= 'http://admin.danang24h.vn/?act=SearchNews&keyword='+key ;
}
function filter(page)
{
    date_time = $('#datepicker').val();
    category = $('#select_cat').val();
    user_id = $('#select_user').val();
    if(typeof(date_time) === "undefined" || typeof(category) === "undefined" || date_time =='Chọn ngày')
    {
        date_time = 0;
    }
    $.ajax({
        url : '/',
        type : "GET",
        dataType : "html",        
        data : {
            act : "FilterNews",
            date : date_time,
            id :  category,
            user_id :  user_id,
            flag : flag,
            page : page                         
        },
        success : function(data)
        {
          $("#list_news").empty();
          $("#list_news").html(data).fadeIn("fast");          
        },
        error : function()
        {
            console.log('a');
        }
        
    });
}