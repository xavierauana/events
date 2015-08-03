/**
 * Created by Xavier on 3/8/15.
 */
var oldContainer;
var listData = [];
var createNestedList = function(){
    var lists = $('.panel-default li');
    $.each(lists, function(index, val){
        var parentId = $(this).attr('data-id');
        var olTemplate = $('<ol />',{
            'class':'list-unstyled submenu',
            'data-parentId': parentId
        });
        if($(val).has($('ol')).length == 0) $(val).append(olTemplate);
    })
};
var getAllListData = function(){
    listData = [];
    var lists = $('.panel-body li');
    $.each(lists, function(index, list){
        list = $(list);
        listData.push({
            id: list.attr('data-id'),
            parentId: list.attr('data-parentId'),
            order: list.index()
        })
    });
    console.log(listData);
};
//createNestedList();
getAllListData();
var lists = $('.panel-body ol[data-menuGroupId]');
var sortableLists = [];
$.each(lists, function(index, val){
    val = $(val);
    var menuGroupId = val.attr('data-menuGroupId');
    console.log( typeof(menuGroupId));
    if( typeof(menuGroupId) != 'undefined')
    {
        sortableLists[menuGroupId] = val.sortable({
            delay: 500,
            afterMove: function (placeholder, container) {
                if(oldContainer != container){
                    if(oldContainer) oldContainer.el.removeClass("active");
                    container.el.addClass("active");
                    oldContainer = container
                }
            },
            onDrop: function(item, container, _super){
                var parentId = $(container.el).attr('data-parentId');
                $(item).attr('data-parentId',parentId);
                container.el.removeClass("active");
                _super(item, container);
                //createNestedList();
                getAllListData();
            }
        });
    }
});

$('.update-button').click(function(e){
    e.preventDefault();
    var menuGroupId = $(this).attr('data-menu-group');
    url = '/admin/menus/'+menuGroupId+'/update';
    //console.log(url);
    var data = {data : JSON.stringify(listData)};
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    var request = $.ajax({
        url:url,
        data:data,
        method: "POST"
    });
    request.done(function(data){
        console.log(data);
        swal({
            title: "Update Success!",
            text: "Lists order have been saved ",
            type: "success",
            timer: 1500,
            showConfirmButton: false
        });
    })
});
