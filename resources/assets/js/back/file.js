/**
 * Created by Xavier on 24/7/15.
 */
$(function(){
    //Initialize variables file
    var fileRemovalButton = $('button.file-remove-button');
    var fileUploadButton = $('button.file-upload-button');
    var fileFileInput = $('input[type="file"][accept="*"]');
    var fileContainer = $('.file-container');

    var init = function(){
        fileRemovalButton.hide();
        console.log('file.js initialized')
    };

    init();

    // Initialize button appearance
    $.each(fileContainer,function(){
        var item = $(this).find('.item');
        if(item.length>0)
        {
            $(this).parent().siblings('div').find('.file-remove-button').show();
            $(this).parent().siblings('div').find('.file-upload-button').text('Change File');
        }
    });

    // when upload button click.
    // mimic the file input clicked.
    fileUploadButton.click(function(e){
        e.preventDefault();
        console.log('upload button clicked');
        var input =  $(this).siblings('input[type="file"][data-type="file"]');
        input.click();
    });

    // when remove button clicked
    // empty file input value
    // hide preview image tag
    fileRemovalButton.click(function(e){
        e.preventDefault();
        var lang_id = $(this).attr('data-lang_id');
        var field = $(this).attr('data-field');
        var file = $(this).parent().siblings().find("[data-lang_id='"+lang_id+"'][data-field='"+field+"']");
        var remover = $(this).siblings('select[name="'+field+'_remove[]"]');
        var input = $(this).siblings('input[type="file"]');
        var upload_button = $(this).siblings('button.file-upload-button');
        var message = 'are you sure you want to delete the file?';

        if(confirm(message))
        {
            remover.val(1);
            file.remove();
            input.val("");
            upload_button.text("Upload File");
            $(this).hide();
        }
    });
    fileFileInput.change(function(){
        $(this).siblings('.file-remove-button').show();
        $(this).siblings('.file-upload-button').text('Change File');
        var index = $(this).val().lastIndexOf("\\");
        var fileName = $(this).val().substring(index+1);
        console.log($(this).val());
        if(fileContainer.find("strong").length == 0)
        {
            fileContainer.html("<p><strong>"+fileName+"</strong></p>")
        }else{
            fileContainer.find("strong").html(fileName);
        }
    });
});