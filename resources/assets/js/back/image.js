/**
 * Created by Xavier on 24/7/15.
 */
$(function(){
    ////Initialize variables file
    //var imageRemovalButton = $('button.image-file-remove-button');
    //var imageUploadButton = $('button.image-file-upload-button');
    //var imageFileInput = $('input[type="file"][accept="image/*"]');
    //var fileContainer = $('.image-file-container');
    //
    //var init = function(){
    //    imageRemovalButton.hide();
    //    console.log('image.js initialized')
    //};
    //
    //init();
    //
    //// Initialize button appearance
    //$.each(fileContainer,function(){
    //    var item = $(this).find('.item');
    //    if(item.length>0)
    //    {
    //        $(this).parent().siblings('div').find('.image-file-remove-button').show();
    //        $(this).parent().siblings('div').find('.image-file-upload-button').text('Change File');
    //    }
    //});
    //
    //// when upload button click.
    //// mimic the file input clicked.
    //imageUploadButton.click(function(e){
    //    e.preventDefault();
    //    console.log('upload button clicked');
    //    var input =  $(this).siblings('input[type="file"][data-type="image"]');
    //    input.click();
    //});
    //
    //// when remove button clicked
    //// empty file input value
    //// hide preview image tag
    //imageRemovalButton.click(function(e){
    //    e.preventDefault();
    //    var lang_id = $(this).attr('data-lang_id');
    //    var field = $(this).attr('data-field');
    //    var img = $(this).parent().siblings().find("[data-lang_id='"+lang_id+"'][data-field='"+field+"']");
    //    var remover = $(this).siblings('select[name="'+field+'_remove[]"]');
    //    var input = $(this).siblings('input[type="file"]');
    //    var upload_button = $(this).siblings('button.image-file-upload-button');
    //    var message = 'are you sure you want to delete the pic?';
    //
    //    if(confirm(message))
    //    {
    //        remover.val(1);
    //        img.remove();
    //        input.val("");
    //        upload_button.text("Upload File");
    //        $(this).hide();
    //    }
    //});
    //
    //// when the field input has a file load.
    //// load the image to preview img section
    //function loadPreviewImage() {
    //    // this is refer to the HTML file input element
    //    if (this.files && this.files[0]) {
    //        var reader = new FileReader();
    //        var container = $(this).parents('div.well').find('div.image-file-container');
    //        var preview = container.children('img');
    //        console.log(preview.length);
    //        if (preview.length == 0) {
    //            var dataField = $(this).attr('data-field');
    //            var dataLangId = $(this).attr('data-lang_id');
    //            container.append('<img data-field="' + dataField + '" data-lang_id="' + dataLangId + '" class="thumbnail item" width="100%" src="" alt=""/>')
    //            preview = container.children('img');
    //        }
    //        preview = $(this).parents('.well').find('img');
    //        reader.onload = function (e) {
    //            preview.attr('src', e.target.result).end().show();
    //        };
    //        reader.readAsDataURL(this.files[0]);
    //    }
    //}
    //
    //imageFileInput.change(function(){
    //    $(this).siblings('.image-file-remove-button').show();
    //    $(this).siblings('.image-file-upload-button').text('Change File');
    //    loadPreviewImage.call(this);
    //});
});