   function listthumb()
    {        
    var first = getUrlVars()["nid"];     
    var imageContainer = $('#display-list-thumb');    
            $.ajax({        
                type : "POST",
                url : "/",
                data : {act:"acpListThumb",id :first},
                success : function(html){
                    imageContainer.html(html);
                }
            });     
    }
  function uploadImageUrl(){
        var ajaxUrl ='/';
        var imgurl = $("#link_url").val();        
        if(imgurl=="")
        {
            alert('Vui lòng nhập URL ảnh');
            return false;
        }        
        $.post(ajaxUrl, {
                act : "mediaAction", action : "uploadimgLink",imglink : imgurl
            },           
             function(str){                
                    $('#display-file-content').prepend(str);
                }
          
        );
    }; 
    
$(function(){
    var btnUpload=$('#upload');
    var status=$('#status');
    var uploadUrl = '/';
    var submitVar = 'fileUpload';
    new AjaxUpload(btnUpload, { 
        action: uploadUrl,
        name: submitVar,
        data: {
            act: 'newsUpload',
            action : 'uploadvideo',
        },
        responseType: false,
        onSubmit: function(file, ext){
             //if (! (ext && /^(jpg|png|jpeg)$/.test(ext))){ 
                // extension is not allowed 
               // status.text('Only JPG, PNG or GIF files are allowed');
                //return false;
//            }
            status.text('Uploading...');
        },
        onComplete: function(file, response){
            response = JSON.parse(response);
            //On completion clear the status
            status.text('');
            //Add uploaded file to list
            if (typeof response.msg != 'undefined' && response.msg != "ok"){
                alert(response.msg);
                return false;
            }
            if(response){                                
                    ihtml = '<div style="float:left;padding: 10px; margin: 15px 15px 15px 15px;border:#ccc 1px solid;width: 145px;background-color:#fff"><div style="background:#b0c4de no-repeat center;height:80px;"></div><center><a style="color:#288FB8;text-decoration:none" title="Chèn video này vào trong nội dung!" class="gallery" onclick="insertVideo(\''+ response.file_link +'\');return false" href="javascript:void(0);"><strong>Chèn video</strong></a></center></div>';                    
                    $('#display-file-content').prepend(ihtml);            
                return false;
            } else{
                return false;
            }
           
        }
    });
    
});
