// send html to the post editor
function send_to_editor(h) {
    var ed;
    top.tinyMCE.execInstanceCommand('mceInsertContent',false, h);
    ed.execCommand('mceInsertContent', false, h);


    self.parent.tb_remove();
}

// thickbox settings
    var tb_position;
    (function($) {
        tb_position = function() {
            var tbWindow = $('#TB_window'), width = $(window).width(), H = $(window).height(), W = ( 720 < width ) ? 720 : width;

            if ( tbWindow.size() ) {
                tbWindow.width( W - 50 ).height( H - 45 );
                $('#TB_iframeContent').width( W - 50 ).height( H - 75 );
                tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2),10) + 'px'});
                if ( typeof document.body.style.maxWidth != 'undefined' )
                    tbWindow.css({'top':'20px','margin-top':'0'});
            };

            return $('a.thickbox').each( function() {
                var href = $(this).attr('href');
                if ( ! href ) return;
                href = href.replace(/&width=[0-9]+/g, '');
                href = href.replace(/&height=[0-9]+/g, '');
                $(this).attr( 'href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 ) );
            });
        };

        $(window).resize(function(){ tb_position(); });

    })(jQuery);

        function insert_uploaded_photo(src) {

            if (tinyMCE && (ed = tinyMCE.get('mceEditor'))) {

                ed.execCommand('mceInsertContent', false, '<img src="' + src + '" />');     

            }

        }
    function sendEditor(key) {
        var keyId = '#url-' + key;
        var str = $(keyId).val();
        if(str == 'undefined') {
            alert('Could not running this javascript !');
        }else {
            var imgPath = '<img src="' + str + ' >"';
            $(send_to_editor(imgPath),top.document);
        }
        /*jQuery.post(ajaxUrl, {
            act: "mediaAction", action: "send-image-to-editor", id: id, fid: thumb_id
        }, function(str) {
            if (str == '0') {
                alert(' Could not send image to editor !');
            }else {
                $(send_to_editor(str), top.document);
            }
        });*/
    };
jQuery(document).ready(function($){
    $('a.thickbox').click(function(){
        if ( typeof tinyMCE != 'undefined' && tinyMCE.activeEditor ) {
            tinyMCE.get('content').focus();
            tinyMCE.activeEditor.windowManager.bookmark = tinyMCE.activeEditor.selection.getBookmark('simple');
        }
    });
});
