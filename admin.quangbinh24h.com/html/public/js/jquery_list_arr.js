/* $(document).ready(function() {     
 pageList(page);
});
function pageList(page)
{       
    $.ajax({
        type : "POST",
        url : "/",
        data : {act:action,page : page},
        success : function(html){
            $('#list_arr').html(html);
        }
    });
}*/
function deleted_comment(id)
{           
    var action='deleted';
    var act='commentEditProcess';
    $.ajax({
        type : "POST",
        url : "/",
        alert(action+act),
        data : {act: act,action : action,id : id},
        success : function(html){
            alert("Đã xóa commment");
        }
    });
}