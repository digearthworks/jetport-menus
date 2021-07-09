<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    /* Reset some default styling */
    .gjs-cv-canvas {
        top: 0;
        width: 100%;
        height: 100%;
    }
</style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="/grapesjs/css/grapes.min.css">
<link rel="stylesheet" href="/grapesjs-preset-webpage/grapesjs-preset-webpage.min.css">
<script type="text/javascript" src="https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script>

<script src="/grapesjs/grapes.min.js"></script>
<script src="/grapesjs-preset-webpage/grapesjs-preset-webpage.min.js"></script>
<script src="/grapesjs-plugin-ckeditor/grapesjs-plugin-ckeditor.min.js"></script>
    <!--
    If you need plugins, put them below the main grapesjs script
    <script src="/path/to/some/plugin.min.js"></script>
    -->
<div class="antialiased">

    <div wire:ignore>

        <div class="px-2" id="gjs">
        </div>
        <div id="blocks"></div>

    </div>
<script type="text/javascript">
document.addEventListener('livewire:load', function () {

    CKEDITOR.dtd.$editable.span = 1
    // CKEDITOR.dtd.$editable.a = 1
    // CKEDITOR.dtd.$editable.td = 1
    // CKEDITOR.dtd.$editable.tr = 1
    // CKEDITOR.dtd.$editable.table = 1

    let ckeConfig = {!! json_encode(array_merge(config('turbine.ckeditor.grapejs'), ['filebrowserUploadUrl' => route('admin.ckeditor.upload', ['_token' => csrf_token() ]), 'filebrowserUploadMethod' => 'form'])) !!} 

    window.grapesjsEditor = grapesjs.init({
        container : '#gjs',
        components: {!! json_encode(isset($state['html']) ? $state['html'] : '') !!},
        style: {!! json_encode(isset($state['css']) ? $state['css'] : '') !!},
        showDevices: false,
        noticeOnUnload: false,
        plugins: [
            'gjs-preset-webpage',
            'gjs-plugin-ckeditor'
        ],
     
        pluginsOpts: {
            'gjs-plugin-ckeditor': ckeConfig
        },
    

        storageManager: {
            type: 'none',
            autosave: false,
            autoload: false,
            storeComponents: false,
            storeStyles: false,
            storeHtml: false,
            storeCss: false,
        },
    });
    var panelManager = grapesjsEditor.Panels;
    panelManager.addButton('options', [{
        id: 'undo',
        className: 'fa fa-undo',
        command: 'undo',
        attributes: { title: 'Undo (CTRL/CMD + Z)'}
    },{
        id: 'redo',
        className: 'fa fa-repeat',
        attributes: {title: 'Redo'},
        command: 'redo',
        attributes: { title: 'Redo (CTRL/CMD + SHIFT + Z)' }
    }]);
    var blockManager = grapesjsEditor.BlockManager;
    blockManager.get('text').set('content', {
        type: 'text',
        content: 'Insert your text here',
        activeOnRender: 1
    });

    const editor = grapesjsEditor;

    var pfx = editor.getConfig().stylePrefix;
    var modal = editor.Modal;
    var cmdm = editor.Commands;
    var codeViewer = editor.CodeManager.getViewer('CodeMirror').clone();
    var pnm = editor.Panels;
    var container = document.createElement('div');
    var btnEdit = document.createElement('button');

    codeViewer.set({
        codeName: 'htmlmixed',
        readOnly: 0,
        theme: 'hopscotch',
        autoBeautify: true,
        autoCloseTags: true,
        autoCloseBrackets: true,
        lineWrapping: true,
        styleActiveLine: true,
        smartIndent: true,
        indentWithTabs: true
    });

    btnEdit.innerHTML = 'Save Changes';
    btnEdit.className = pfx + 'btn-prim ' + pfx + 'btn-import';
    btnEdit.onclick = function() {
        var code = codeViewer.editor.getValue();
        editor.DomComponents.getWrapper().set('content', '');
        editor.setComponents(code.trim());
        modal.close();
    };

    cmdm.add('html-edit', {
        run: function(editor, sender) {
            sender && sender.set('active', 0);
            var viewer = codeViewer.editor;
            modal.setTitle('Edit code');
            if (!viewer) {
                var txtarea = document.createElement('textarea');
                container.appendChild(txtarea);
                container.appendChild(btnEdit);
                codeViewer.init(txtarea);
                viewer = codeViewer.editor;
            }
            var InnerHtml = editor.getHtml();
            var Css = editor.getCss();
            modal.setContent('');
            modal.setContent(container);
            codeViewer.setContent(InnerHtml + "<style>" + Css + '</style>');
            modal.open();
            viewer.refresh();
        }
    });

    pnm.addButton('options',
        [
            {
                id: 'edit',
                className: 'fa fa-edit',
                command: 'html-edit',
                attributes: {
                    title: 'Edit Code'
                }
            }
        ]
    );

//     const rte = editor.RichTextEditor;

// // An example with fontSize
// rte.add('fontSize', {
//   icon: `<select class="gjs-field">
//         <option>1</option>
//         <option>2</option>
//         <option>3</option>
//         <option>4</option>
//         <option>5</option>
//         <option>6</option>
//         <option>7</option>
//       </select>`,
//     // Bind the 'result' on 'change' listener
//   event: 'change',
//   result: (rte, action) => rte.exec('fontSize', action.btn.firstChild.value),
//   // Callback on any input change (mousedown, keydown, etc..)
//   update: (rte, action) => {
//     const value = rte.doc.queryCommandValue(action.name);
//     if (value != 'false') { // value is a string
//       action.btn.firstChild.value = value;
//     }
//    }
//   })


    // Run a callback when an event ("foo") is emitted from this component
    @this.on('storing-page', () => {
        @this.set('state.html', grapesjsEditor.getHtml());
        @this.set('state.css', grapesjsEditor.getCss());
        @this.createPage();
    })
    // Run a callback when an event ("foo") is emitted from this component
    @this.on('updating-page', () => {
        @this.set('state.html', grapesjsEditor.getHtml());
        @this.set('state.css', grapesjsEditor.getCss());
        @this.updatePage();
    })
    // Run a callback when an event ("foo") is emitted from this component
    @this.on('saving-page-as', () => {
        @this.set('state.html', grapesjsEditor.getHtml());
        @this.set('state.css', grapesjsEditor.getCss());
        @this.savePageAs();
    })

    @this.on('storing-template', () => {
        @this.set('state.html', grapesjsEditor.getHtml());
        @this.set('state.css', grapesjsEditor.getCss());
        @this.createPageTemplate();
    })

    @this.on('updating-template', () => {
        @this.set('state.html', grapesjsEditor.getHtml());
        @this.set('state.css', grapesjsEditor.getCss());
        @this.updatePageTemplate();
    })

    @this.on('saving-template-as', () => {
        @this.set('state.html', grapesjsEditor.getHtml());
        @this.set('state.css', grapesjsEditor.getCss());
        @this.savePageTemplateAs();
    })

    @this.on('swap-template', e => {
        let content = JSON.parse(e);
        grapesjsEditor.setComponents(content.html);
        grapesjsEditor.setStyle(content.css);
    })
})


</script>
