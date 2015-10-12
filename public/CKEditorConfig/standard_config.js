/**
 * Created by Xavier on 17/9/15.
 */
CKEDITOR.editorConfig = function( config ) {
    config.language = 'en';
    config.filebrowserUploadUrl= '/CKEditorFileUploader/upload';
    config.toolbarCanCollapse= true;
    config.toolbar= [
        { name: 'clipboard',   items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo'  ] },
        { name: 'editing',   items: [ 'Scayt'  ] },
        { name: 'links',   items: [ 'Link', 'Unlink'  ] },
        { name: 'inserts',   items: [ 'Image', 'Table', "HorizontalRule", "SpecialChar"  ] },
        { name: 'tools',   items: [ 'Maximize'  ] },
        { name: 'basicstyles',   items: [ 'Bold', "Italic", "Strike",'-','RemoveFormat'  ] },
        { name: 'paragraph',   items: [ 'NumberedList', "BulletedList", '-','OutDent', 'Indent', '-', 'Blockquote'  ] }
    ]
};