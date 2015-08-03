/**
 * Created by Xavier on 24/7/15.
 */
$(function(){
    //Initialize CKEditor

    // replace all textarea with CKEditor
    var targets = $("textarea");
    $.each(targets,function(i, val){
        var target = $(val);
        var id = target.attr('id');
        var settings = {
            filebrowserBrowseUrl: '/admin/CKEditorFileBrowser?type=Images&CKEditor=editor2&CKEditorFuncNum=2&langCode=en',
            filebrowserUploadUrl: '/CKEditorFileUploader/upload.php',
            toolbarCanCollapse: true,
            toolbarGroups: [
                { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'links', groups: [ 'links', 'insert' ] }
            ]
        };
        if(id.search('meta_') < 0)
        {
            target.ckeditor(settings);
        }
    });
});