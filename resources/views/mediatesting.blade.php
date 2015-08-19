@extends("back.layouts.default")


        @section("stylesheets")
            <style>
                div.img-container.img-rounded{
                    border: 2px solid white;
                }
                div.img-container.img-rounded.selected{
                    border: 2px solid blue;
                }
            </style>
        @endsection
        @section("content")
            <?php
                $uuid = time();
                $uuid2 = time()+10;
            ?>
            <input type="text"  class="image" name="image" data-uuid="{{$uuid}}">

            <div class="preview" data-uuid="{{$uuid}}" >
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mediaLibrary" data-input="{{$uuid}}">
                Media Library
            </button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" onclick="resetInput(event)" data-input="{{$uuid}}">
                Remove Image
            </button>
            <input type="text"  class="image" name="image" data-uuid="{{$uuid2}}">

            <div class="preview" data-uuid="{{$uuid2}}" >
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mediaLibrary" data-input="{{$uuid2}}">
                Media Library
            </button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" onclick="resetInput(event)" data-input="{{$uuid2}}">
                Remove Image
            </button>


        @endsection

        @section('scripts')

        @endsection