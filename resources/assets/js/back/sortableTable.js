/**
 * Created by Xavier on 10/8/15.
 */
$(function(){
    var tables = $(".sortableTable");
    var options ={};
    if(tables.length>0){
        $.each(tables, function(index, el){
            $(el).DataTable(options)
        });
    }
});