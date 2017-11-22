function upNewsFormSubmit(){
    if ($("input[name='name_1']").attr("value").length > 50 || $("input[name='name_1']").attr("value").length < 3 ){
        alert("Tên bạn nhập quá dài hoặc quá ngắn");
        return false;
    }
    if (!validateEmail($("input[name='email_1']").attr("value"))){
        alert("Email của bạn không đúng");
        return false;
    }
    if ($("input[name='title_1']").attr("value").length > 255 || $("input[name='title_1']").attr("value").length < 10 ){
        alert("Tiêu đề bạn nhập quá dài hoặc quá ngắn,trong khoảng 10 đến 255 ký tự");
        return false;
    }
    if ($("input[name='site_1']").attr("value").length > 255 || $("input[name='site_1']").attr("value").length < 1 ){
        alert("Url không đúng");
        return false;
    }
    $("#upNewsForm").submit();
}

function validateEmail(id)
{
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;
    return emailPattern.test(id);
}

function seturl(redirect){
    $.cookie("last_cache_news_url", $(location).attr('href'),{ path: '/' }); 
    $(window.location).attr('href', redirect); 
}
function seturl1(){
    $.cookie("last_cache_news_url", $(location).attr('href'),{ path: '/' }); 
}
function rsubmit(){
    $.cookie("last_cache_news_url", $(location).attr('href'),{ path: '/' });
    $("#feature_form").submit();
}

function editNews(){
    $.cookie("last_re_news_url", $(location).attr('href'),{ path: '/' });
    var html = "<input type='hidden' name='editreload' value='1' />";
    $("#more").append(html);
    $('#editNews').submit();
}