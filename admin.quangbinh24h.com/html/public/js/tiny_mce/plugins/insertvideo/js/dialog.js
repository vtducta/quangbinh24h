tinyMCEPopup.requireLangPack();

var ExampleDialog = {
	init : function() {
		var f = document.forms[0];

		// Get the selected contents as text and place it in the input
	//	f.someval.value = tinyMCEPopup.editor.selection.getContent({format : 'text'});
	//	f.somearg.value = tinyMCEPopup.getWindowArg('some_custom_arg');
	},

	insert : function() {
        text = document.forms[0].someval.value;
        embed_code = text;
    //    alert(embed_code);
    //    var text = '<script type="text/javascript" src="http://embed.mecloud.vn/play/gv1Kv2j6ZS"></'+'script>';
   // http://embed.videondt.com/play/ZJGsEV8wwm"></script>
        regexp = /videondt\.com\/play\/(.*)(\"|\')/;
        var match = regexp.exec(text);
        id_video = "";
        if (match!= null) {
            id_video = match[1];
            embed_code = '<div class="content_mecloud"><script type="text/javascript" src="http://embed.videondt.com/play/'+id_video+'">// <![CDATA[ rnrn rnrn// ]]></'+'script></div> '; 
        }
        
		// Insert the contents from the input into the document
		tinyMCEPopup.editor.execCommand('mceInsertContent', false, embed_code);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(ExampleDialog.init, ExampleDialog);
