(function() {
    // Load plugin specific language pack
    tinymce.PluginManager.requireLangPack('netlinkVideo');

    tinymce.create('tinymce.plugins.netlinkVideo', {

        init : function(ed, url) {
            /*console.log(url);*/
            ed.addCommand('mceNetlinkVideo', function() {              
                ed.windowManager.open({
                    file : url + '/dialog.htm',
                    width : 580 + parseInt(ed.getLang('netlinkVideo.delta_width', 0)),
                    height : 500 + parseInt(ed.getLang('netlinkVideo.delta_height', 0)),
                    inline : 1,
                    scrollbars : 1
                }, {
                    plugin_url : url, // Plugin absolute URL
                    some_custom_arg : 'Custom argument' // Custom argument                                        
                });
            });
            // Register example button
            ed.addButton('netlinkVideo', {
                title: 'Chèn video vào bài viết',
                cmd : 'mceNetlinkVideo',
                image : url + '/img/code2.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('netlinkVideo', n.nodeName == 'IMG');
            });
        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : 'Insert Code plugin',
                author : 'Rtur.net',
                authorurl : 'http://rtur.net',
                infourl: 'http://rtur.net/blog/post/2009/11/26/Building-custom-plugin-for-TinyMCE.aspx',
                version : "1.0"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('netlinkVideo', tinymce.plugins.netlinkVideo);
})();