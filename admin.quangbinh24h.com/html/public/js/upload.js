$(document).ready(function() {
    tinyMCE.init({
        theme                            : 'advanced',
        mode                             : 'textareas',
        editor_selector                  : "mceEditor",
        elements                         : 'mceEditor',
        width                            : '800px',
        height                           : '600px',
        language                         : 'en',
        relative_urls                    : true,
        remove_script_host               : true,
        convert_urls                     : true,
        forced_root_block                : 'p',
        force_p_newlines                 : true,
        accessibility_warnings : false,
        theme_advanced_toolbar_location  : 'top',
        theme_advanced_statusbar_location: 'bottom',
        theme_advanced_toolbar_align     : 'ltr',
        theme_advanced_font_sizes        : '80%,90%,100%,120%,140%,160%,180%,220%,260%,320%,400%,500%,700%',        
        //content_css                      : '/css/tinymce/style/content.css',
        formats : {
            alignleft   : {
                selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', 
                classes : 'justifyleft'
            },
            alignright  : {
                selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', 
                classes : 'justifyright'
            },
            alignfull   : {
                selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', 
                classes : 'justifyfull'
            }
        },
        apply_source_formatting          : true,
        remove_linebreaks                : false,
        convert_fonts_to_spans           : true,
        plugins                          : 'table,save,advhr,advimage,advlink,iespell,preview,media,paste,noneditable,xhtmlxtras,imagemanager,netlinkImage,Block',
        theme_advanced_buttons1          : 'undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,fontselect,fontsizeselect,|,cut,copy,paste,|,link,unlink,table,media,image,emotions,|,code,|,netlinkImage,|,Block',
        theme_advanced_buttons2          : 'sub,sup,|,hr,|,outdent,indent,|,bullist,numlist,|,fullscreen,preview',
        theme_advanced_buttons3          : '',
        theme_advanced_buttons4          : '',
        theme_advanced_resize_horizontal :  false,
        external_link_list_url           : 'js/tinymce/inc/tinymce.linklist.php',
        theme_advanced_blockformats      : 'p,h1,h2,h3,h4,h5,h6,div,blockquote,code,pre',
        theme_advanced_styles            : '',
        theme_advanced_disable           : '',
        theme_advanced_resizing          : true,
        fullscreen_settings : {
            theme_advanced_buttons1_add_before : 'save'
        },
        
    });
}); 
$(document).ready(function() {
    tinyMCE.init({
        theme                            : 'advanced',
        mode                             : 'textareas',
        editor_selector                  : "mce",
        elements                         : 'mce',
        width                            : '580px',
        height                           : '80px',
        language                         : 'en',
        relative_urls                    : true,
        remove_script_host               : true,
        convert_urls                     : true,        
        forced_root_block                : false,
        force_br_newlines                : true,
        force_p_newlines                 : false,
        accessibility_warnings           : false,
        theme_advanced_toolbar_location  : 'top',
        theme_advanced_statusbar_location: 'bottom',
        theme_advanced_toolbar_align     : 'ltr',
        theme_advanced_font_sizes        : '80%',
        //content_css                      : 'js/box-tin-moi.css',
        //content_css                      : '/css/tinymce/style/content.css',
        formats : {
            alignleft   : {
                selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', 
                classes : 'justifyleft'
            },
            alignright  : {
                selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', 
                classes : 'justifyright'
            },
            alignfull   : {
                selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', 
                classes : 'justifyfull'
            }
        },
        apply_source_formatting          : true,
        remove_linebreaks                : false,
        convert_fonts_to_spans           : true,
        plugins                          : 'table,save,advhr,advimage,advlink,iespell,preview,media,paste,noneditable,xhtmlxtras,imagemanager',
        theme_advanced_buttons1          : 'justifyleft,justifycenter,justifyright,|,link,unlink,|,code',
        theme_advanced_buttons2          : '',
        theme_advanced_buttons3          : '',
        theme_advanced_buttons4          : '',
        theme_advanced_resize_horizontal :  false,
        external_link_list_url           : 'js/tinymce/inc/tinymce.linklist.php',        
        theme_advanced_styles            : '',
        theme_advanced_disable           : '',
        theme_advanced_resizing          : true,
        fullscreen_settings : {
            theme_advanced_buttons1_add_before : 'save'
        },
        
    });
});          
document.wirte("http://admincms.nguoiduatin.vn/js/image_upload/ctv_article_upload.js") ;
$(document).ready(function(){
    var btnUpload=$("#upload");
    var status=$('#status');
    var uploadUrl = '/';
    var submitVar = 'fileUpload';
    new AjaxUpload(btnUpload, {
        action: uploadUrl,
        name: submitVar,
        data: {
            act: 'newsUpload',
            action : 'ajaxUpload',
        },
        responseType: false,
        onSubmit: function(file, ext){
             if (! (ext && /^(jpg|png|jpeg)$/.test(ext))){ 
                // extension is not allowed 
                alert("Chi cho phép file jpg, png");
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
                //$('<li></li>').appendTo('#files').html('<img src="'+response+'" alt="" /><br />'+file).addClass('success');
                $('#display-file').html('<img src="' + formData.thumb + '">');
                $('#file_name').val(formData.file_name);
                $('#flagthumb').val('1');
            } else{
                $('<li></li>').append('#files').text(file).addClass('error');
            }
        }
    });
});                         
