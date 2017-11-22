function filter()
{                                            
    var date_time = $('#datepicker').val();
    var category = $('#select_cat').val();
    if(date_time=='Chọn ngày'){
        date_time = 0;
    }
    /*if(date_time =='Chọn ngày' || category == 0)
    {
        alert('Vui lòng chọn ngày và chọn chuyên mục');
        return false;
    }    */
    window.location= 'http://admincms.nguoiduatin.vn/?act=newsfilter&category='+category+'&date_time='+date_time ;
}
function timkiem()
{
    var key=$('#keyword').val();
    if(key=='')
    {
        alert('Vui lòng nhập vào từ khóa!');
        return false;
    }
    window.location= 'http://admincms.nguoiduatin.vn/?act=newsearch&keyword='+key ;
}                                      
                                      