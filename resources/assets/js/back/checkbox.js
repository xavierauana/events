/**
 * Created by Xavier on 24/7/15.
 */
$(function(){
    var checkboxes = $('input[type="checkbox"]');
    $('form').submit(function(e){
        $.each(checkboxes, function(index, checkbox){
            var input = $(checkbox);
            input.hide();
            if(!input.prop('checked'))
            {
                input.val(0);
            }
        });
        return true;
    });
});
