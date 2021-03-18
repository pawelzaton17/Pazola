(function($) {
    tinymce.create('tinymce.plugins.default_theme', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {

            // Elements button
            ed.addButton('elements', {
                text: 'Elements',
                title: 'Page Elements Shortcodes',
                type: 'menubutton',
                menu: [
                    {
                        text: 'Button',
                        onClick: function() {
                            ed.windowManager.open({
                                title: 'Button Settings',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'btnUrl',
                                        label: 'Button URL: '
                                    },
                                    {
                                        type: 'textbox',
                                        name: 'btnLabel',
                                        label: 'Button Text: '
                                    }
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent('[c_button href="' + e.data.btnUrl + '" label="' + e.data.btnLabel + '"/]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Blockquote',
                        onClick: function() {
                            ed.windowManager.open({
                                title: 'Blockquote Settings',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'author',
                                        label: 'Author: '
                                    }
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent('[blockquote author="' + e.data.author + '"]' + ed.selection.getContent() + '[/blockquote]');
                                }
                            });
                        }
                    },
                ]
            });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Default Theme Editor Buttons',
                author : 'Default Theme'
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add( 'default_theme', tinymce.plugins.default_theme );
})(jQuery);
