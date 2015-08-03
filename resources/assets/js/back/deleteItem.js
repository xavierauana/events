/**
 * Created by adrianexavier on 24/7/15.
 */
(function($){
    $.fn.deleteItem = function(options) {
        var target = this;
        var token = $('meta[name="csrf-token"]').attr('content');
        var settings = $.extend({}, $.fn.deleteItem.defaults,options);
        var identifier = target.attr(settings.identifierTag);
        var url = settings.url+'/'+identifier;

        function fireAjax(){
            console.log(url);
            // setting csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            // fired ajax
            var request = $.ajax({
                url: url,
                method: settings.method,
                dataType: "json"
            });

            //
            request.always(function () {
                console.log('loading...');
            });

            // ajax return success
            request.done(function (data) {
                if (data.response == "completed") {
                    target.parents(settings.removableEl).remove();
                    swal("Deleted!", "The item has been deleted.", "success");
                }
                if(data.hasOwnProperty('error'))
                {
                    alert(data.error);
                }
            });
        }


        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this item!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            },
            function(){
                fireAjax();
            });
    };


    // Default setting
    $.fn.deleteItem.defaults = {
        message:'Are you sure you want to delete it?',
        identifierTag: 'data-id',
        url : 'contents',
        method : 'DELETE',
        removableEl: 'tr'
    };
}(jQuery));