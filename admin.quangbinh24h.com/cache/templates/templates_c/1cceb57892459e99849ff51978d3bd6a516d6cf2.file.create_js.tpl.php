<?php /* Smarty version Smarty-3.1.12, created on 2017-09-16 11:09:16
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/journalist/create_js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197414394559bca3ec6cf4e2-36822964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cceb57892459e99849ff51978d3bd6a516d6cf2' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/journalist/create_js.tpl',
      1 => 1504767331,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197414394559bca3ec6cf4e2-36822964',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59bca3ec6d5e41_75914707',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59bca3ec6d5e41_75914707')) {function content_59bca3ec6d5e41_75914707($_smarty_tpl) {?><script src="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Js'];?>
ajax_upload.js" type="text/javascript"></script>

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
<?php }} ?>