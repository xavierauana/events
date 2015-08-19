 <!-- Modal -->
        <div class="modal fade" id="mediaLibrary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Media Library</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#myModalLabel_AllFiles" aria-controls="home" role="tab" data-toggle="tab">All Files</a></li>
                            <li role="presentation"><a href="#myModalLabel_Images" aria-controls="profile" role="tab" data-toggle="tab">Image</a></li>
                            <li role="presentation"><a href="#myModalLabel_UploadNewFiles" aria-controls="messages" role="tab" data-toggle="tab">Upload New</a></li>
                            <li role="presentation"><a href="#myModalLabel_ExternalLink" aria-controls="links" role="tab" data-toggle="tab">Upload New</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane clearfix active" id="myModalLabel_AllFiles">
                                <br>
                                <input type="text" v-model="search" class="pull-right form-control" placeholder="search">
                                <hr>
                                <div class="row" style="max-height:300px; overflow: scroll;">
                                    <div class="col-xs-2" v-repeat="file: media">
                                        <div class="img-container img-rounded"
                                             data-index="@{{ $index }}"
                                                style="width: 120px; height:120px; overflow: hidden; margin-top:15px; margin-bottom:15px;">
                                            <img v-on="click: toggleSelect" src="@{{file.link}}" class="img-responsive" alt="">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-success pull-right" data-dismiss="modal"  v-on="click: getSelectedImage" style="margin-left:15px">Select</button>
                                <button class="btn btn-danger pull-right" v-on="click: deleteSelectedFile" style="margin-left:15px">Delete</button>
                                <button class="btn btn-default pull-right" v-on="click: resetAllSelectedContainers" data-dismiss="modal" >Close</button>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="myModalLabel_Images">Image</div>
                            <div role="tabpanel" class="tab-pane clearfix" id="myModalLabel_UploadNewFiles">
                                Upload New Files
                                <hr>
                                <form action="{{route("admin.file.upload")}}" enctype="multipart/form-data"
                                      class="dropzone"
                                      id="myFileDropzone">
                                    {{csrf_field()}}
                                </form>
                                <hr>
                                <button class="btn btn-default pull-right" data-dismiss="modal" >Close</button>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="myModalLabel_ExternalLink">External Links</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>