<script language="javascript" type="text/javascript" src="{$GUrl.Js}tiny_mce/tiny_mce.js?a=5"></script>
{literal}
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        editor_selector : "mceEditor",
        font_size_style_values : "large",
        elements : 'mceEditor',
        width: '100%',
        height : '600px',
        dialog_type : "modal",
        plugins : "inlinepopups,Block,autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,netlinkImage,youtube,netlinkVideo,jqueryimage,insertvideo",
        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,|,undo,redo,|,tablecontrols,|,link,unlink,code,|,preview,|,removeformat,|, youtube, |,jqueryimage, |,fullscreen",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        extended_valid_elements : "....., script[charset|defer|language|src|type]",
        theme_advanced_resizing : true,
        convert_newlines_to_brs : true,
        remove_linebreaks : true,
        apply_source_formatting : false,
        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        //content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        //template_external_list_url : "js/template_list.js",
       // external_link_list_url : "js/link_list.js",
       // external_image_list_url : "js/image_list.js",
       //media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
</script>
{/literal}
<script src="{$GUrl.Js}ajax_upload.js" type="text/javascript"></script>
{literal}
<script type="text/javascript">
   $(document).ready(function(){
        var btnUpload=$("#upload");
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
                    alert("Chi cho phép file jpg, png");
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
                //response = response.replace(/Bad group name: 5./g, "");    
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
                    $('#flagthumb').val(formData.id);
                } else{
                    $('<li></li>').append('#files').text(file).addClass('error');
                }
            }
        });
    });
</script>
{/literal}
