{literal} 
<script type="text/javascript">
    $(document).ready(function(){       
        var btnUpload=$("#uploadfile");
        var status=$('#statusfile');
        var uploadUrl = '/';
        var submitVar = 'fileUpload';
        new AjaxUpload(btnUpload, {
            action: uploadUrl,
            name: submitVar,
            data: {
                act: 'UploadFile',
            },
            responseType: false,
            onSubmit: function(file, ext){
                 if (! (ext && /^(mp4)$/.test(ext))){ 
                    // extension is not allowed 
                    alert("Chi cho phép file mp4");
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
                    if(formData.msg =='false'){
                        alert(formData.msgbox);
                        return false;
                    }
                    console.log(formData.file_link);
                    $('#display-file-doc').html(formData.file_link);
                    $('#link').val(formData.file_link);
                }else{
                    $('<li></li>').append('#files').text(file).addClass('error');
                }
            }
        });
    });
</script>
{/literal}