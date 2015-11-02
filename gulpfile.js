var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less("app.less",'./public/front/css/app.css');
    mix.less("back/back.less",'./public/back/css/app.css');
    mix.less("transitionContainer/b.less",'./public/front/css/bootstrap.css',{
        paths: __dirname + '/resources/vendor/bootstrap/less'
    });

    mix.browserify('month.js', './public/js/monthBundle.js');

    mix.copy('resources/vendor/ckeditor','public/js/ckeditor');

    // Concatenate All Front End Script Files
    mix.scripts([
        "bootstrap/dist/js/bootstrap.min.js",
        "underscore/underscore.js",
        "moment/moment.js",
        "clndr/src/clndr.js",
        "vue/dist/vue.min.js",
        "vue-resource/dist/vue-resource.min.js"
    ],"./public/front/js/front.js","./resources/vendor")
    .version("public/front/js/front.js");

    // Concatenate All Back End Script Files
    mix.scripts([
        "vendor/bootstrap/dist/js/bootstrap.min.js",
        "vendor/vue/dist/vue.min.js",
        "vendor/vue-resource/dist/vue-resource.min.js",
        "vendor/moment/moment.js",
        "vendor/jquery-sortable/source/js/jquery-sortable.js",
        "vendor/sweetalert/dist/sweetalert-dev.js",
        "vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js",
        "vendor/dropzone/dist/dropzone.js",
        "vendor/select2/dist/js/select2.min.js",
        "assets/js/back/checkbox.js",
        "assets/js/back/deleteItem.js",
        "assets/js/back/file.js",
        "assets/js/back/image.js",
        "assets/js/back/menuSortableScript.js",
        "assets/js/back/sortableTable.js",
        "assets/js/back/select2.js",
        "assets/js/back/myDateTimePicker.js",
        "assets/js/back/mediaLibary.js",
        "assets/js/back/myCKEditor.js"
    ],"./public/back/js/back.js","./resources");

    // Concatenate All Back End Script Files
    mix.styles([
        "vendor/sweetalert/dist/sweetalert.css",
        "vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css",
        "vendor/dropzone/dist/dropzone.css",
        "vendor/select2/dist/css/select2.min.css"
    ],"./public/back/css/back.css","./resources");

    mix.version([
        "public/front/css/app.css",
        "public/back/css/app.css",
        "public/back/css/back.css",
        "public/back/js/back.js"
    ]);

    // Compile Coffee Script to JS File
    mix.coffee([
        "first.coffee"
    ],"./public/front/js/coffee.js")

});
