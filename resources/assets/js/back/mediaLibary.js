/**
 * Created by Xavier on 13/8/15.
 */

var photoVue = new Vue({
    el : "#mediaLibrary",
    methods:{
        resetAllSelectedContainers: function(){
            $.each($(".selected"), function(index, el){
                $(el).removeClass("selected");
            })
        },
        setInputReference:function(reference){
            this.$set("inputReference", reference);
        },
        addNewMedia:function(mediaObject){
            this.media.push(mediaObject);
        },
        removeMedia:function(index){
            this.media.splice(index, 1);
        },
        getSelectedImage:function(){
            var container, media, path;

            container = $(".selected");
            media = this.media[container.attr("data-index")];
            path = media.link;

            this.showImagePreview(path);
            this.assignValueToReferredInput(path);
            this.resetAllSelectedContainers();
        },
        showImagePreview: function(path){
            var uuid = this.inputReference;
            var preview = $("div.preview[data-uuid='"+uuid+"']");
            var img = preview.find("img");
            if(img.length>0){
                img.attr("src",path);
            }else{
                var imgTag = $("<img />").addClass("img-responsive").attr("src",path);
                preview.append(imgTag);
            }

        },
        resetImagePreview: function () {
            var uuid = this.inputReference;
            var preview = $("div.preview[data-uuid='"+uuid+"']");
            var img = preview.find("img");
            if(img.length>0){
                img.remove();
            }
        },
        toggleSelect:function(e){
            var target = $(e.target).parent("div");
            if(target.hasClass("selected")){
                target.removeClass("selected")
            }else{
                target.addClass("selected")
            }
            console.log(target);
        },
        deleteSelectedFile: function(){
            var self = this;
            swal({
                    title: "The action cannot be revert!",
                    text: "Are you sure you want to delete them?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                /**
                 * the following action is executed when they confirm the delete action.
                 */
                function(){
                    var containers = $(".selected");
                    var deletedImages = 0;
                    var data = {"_token":$('meta[name="csrf-token"]').attr('content')};
                    $.each(containers, function(index, el){
                        var mediaIndex = el.dataset.index;
                        var fileId = self.media[mediaIndex].id;
                        self.$http.delete("/admin/file/"+fileId,data,function(data, status, request){
                            self.removeMedia(mediaIndex);
                            deletedImages = deletedImages+1;
                            if(deletedImages == containers.length){
                                swal({
                                    title: "Completed",
                                    text: "All deleted",
                                    type: "success",
                                    timer: 1500
                                });
                            }
                        }).error(function(data, status, request){
                            console.log(data);
                            console.log(status);
                        })
                    });
                });
        },
        assignValueToReferredInput:function(path){
            var input = $("input[data-uuid='"+this.inputReference+"']");
            input.val(path);
        },
        resetInputValue:function(){
            var input = $("input[data-uuid='"+this.inputReference+"']");
            input.val("");
        },
        resetInput:function(reference){
            this.setInputReference(reference);
            this.resetInputValue();
            this.resetImagePreview();
        }
    },
    ready: function(){
        console.log('file get image ajax');
        this.$http.get("/admin/files",function(data, status, request){
            this.$set("media", data);
            console.log(data);
        }).error(function(data, status, request){
            console.log(data);
            console.log(status);
        })
    }
});
Dropzone.options.myFileDropzone = {
    acceptedFiles:"image/*, video/*",
    init: function() {
        this.on("success", function(file) {
            var responseObject = JSON.parse(file.xhr.response);
            photoVue.addNewMedia(responseObject.fileObject);
        });
    }
};

var modalButton = $("button[data-toggle='modal']");

modalButton.click(function(){
    photoVue.setInputReference(this.dataset.uuid);
    return true;
});

var resetInput = function(e){
    e.preventDefault();
    photoVue.resetInput(e.target.dataset.uuid);
    return false;
}