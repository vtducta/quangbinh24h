
(function() {
    tinymce.create('tinymce.plugins.Block', {

        init : function(ed, url) {
            ed.addCommand('mceBlock', function() {
                ed.windowManager.open({
                    file : 'http://admin.danang24h.vn/?act=SearchVideo',
                    width : 820,
                    height : 550,
                    inline : 1                    
                }, {
                    plugin_url : url, // Plugin absolute URL
                    some_custom_arg : 'custom arg', // Custom argument                    
                });
            });

            // Register example button
            ed.addButton('Block', {
                title: 'Chèn Video vào bài viết',
                cmd : 'mceBlock',
                image : url + '/img/block.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('Block', n.nodeName == 'IMG');
            });
        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : 'Block video meme',
                author : 'tammy',
                version : "1.0"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('Block', tinymce.plugins.Block);
})();
