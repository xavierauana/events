$(function(){
    var selectInputs = $("select.select2");

    if(selectInputs.length > 0){
        $.each(selectInputs, function(index, el){
            var options = {};
            var data = el.dataset;
            for(var key in data){
                options[key] = data[key];
            }
            $(el).select2(options);
        })
    }
});