<?php /* Smarty version Smarty-3.1.12, created on 2017-09-13 14:03:38
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/video_html5/add_js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195126158759b8d84a354e54-96813889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38a422ae354f993d54f87586f21bde430135e18a' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/video_html5/add_js.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195126158759b8d84a354e54-96813889',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b8d84a357385_55998931',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b8d84a357385_55998931')) {function content_59b8d84a357385_55998931($_smarty_tpl) {?> 
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
<?php }} ?>