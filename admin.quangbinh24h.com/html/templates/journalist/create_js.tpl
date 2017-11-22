<script src="{$GUrl.Js}ajax_upload.js" type="text/javascript"></script>
{literal}
<script type="text/javascript">

    $(document).ready(function(){       
        //validate input value form
        $("#addjournalist").validate({ 
            debug: false,
            rules: {
                pen_name : "required",
                email : "required"
            },        
            messages: {
                pen_name: "Bạn cần nhập vào bút danh.",
                email: "Bạn cần nhập vào đúng email user."
            }
        });   

        var btnUpload=$('#upload');
        var status=$('#status');
        var uploadUrl = '/';
        var submitVar = 'fileUpload';
        new AjaxUpload(btnUpload, {            
            action: uploadUrl,
            name: submitVar,
            data: {
                act: 'Upload'               
            },
            responseType: false,
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg)$/.test(ext))){ 
                    // extension is not allowed 
                    alert("Chỉ cho phép file jpg, png");
                    return false;
                }
                var filename = file.replace('.'+ext,'');                
                if(! (/^[a-zA-Z0-9 ._-]*$/.test(filename)))
                    {
                    alert("Chỉ cho phép upload tên file không dấu !");
                    return false;                    
                }                                
                status.text('Đang tải ... ');
            },
            onComplete: function(file, response){
                var formData = JSON.parse(response);
                //On completion clear the status
                status.text('');
                //Add uploaded file to list
                if(response){
                    if(formData.msg =='false')
                        {
                        alert(formData.msgbox);
                        return false;
                    }
                    $('#display-file').html('<img src="' + formData.file_link + '">');                    
                    $('#avatar').val(formData.file_link);
                } else{
                    $('<li></li>').append('#files').text(file).addClass('error');
                }
            }
        });    
    });    
</script>
{/literal}