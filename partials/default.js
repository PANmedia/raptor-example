// Test for no conflict version
var init;
if (typeof raptor !== 'undefined') {
    init = raptor;
} else if (typeof jQuery !== 'undefined') {
    init = jQuery;
} else {
    alert('Could not find initialiser');
}

var preset = 'full';
if (typeof init.fn.raptor.Raptor.presets['full-premium'] !== 'undefined') {
    preset = 'full-premium';
} else if (typeof init.fn.raptor.Raptor.presets['mammoth'] !== 'undefined') {
    preset = 'mammoth';
}

var defaultOptions = {
    preset: preset,
    urlPrefix: '../../src/',
    plugins: {
        save: {
            plugin: 'saveJson'
        },
        saveJson: {
            url: '../../actions/save-content-json.php',
            postName: 'raptor-content',
            id: function() {
                return this.raptor.getElement().data('id');
            }
        },
        dock: {
            docked: true,
            under: '.switcher-spacer'
        },
        classMenu: {
            classes: {
                'Blue background': 'cms-blue-bg',
                'Round corners': 'cms-round-corners',
                'Indent and center': 'cms-indent-center'
            }
        },
        snippetMenu: {
            snippets: {
                'Grey Box': '<div class="grey-box"><h1>Grey Box</h1><ul><li>This is a list</li></ul></div>'
            }
        },
        revisions: {
            url: function() {
                var id = this.raptor.getElement().data('id');
                if (id) {
                    return '../../actions/revisions.php?id=' + id;
                }
            }
        },
        fileManager: {
            uriPublic: '../../data/uploads/',
            uriAction: '../../actions/file-manager.php',
            uriIcon: '../../examples/file-manager/icon/'
        },
        imageEditor: {
            uriSave: '../../actions/image-editor.php'
        }
    }
};

function extendDefaults(options) {
    return init.extend(true, defaultOptions, options);
}
