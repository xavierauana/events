/**
 * Created by Xavier on 24/7/15.
 */
$(function(){
    CKEDITOR.replaceAll(function(textarea,config) {
        if(textarea.className.indexOf("editor") < 0) return false;
        config.customConfig = '/CKEditorConfig/standard_config.js';
        return true;
    });
});