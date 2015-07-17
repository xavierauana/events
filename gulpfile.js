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

    mix.less("month/month.less",'./public/front/css/month.css');
    mix.less("transitionContainer/b.less",'./public/front/css/bootstrap.css',{
        paths: __dirname + '/resources/vendor/bootstrap/less'
    });


    mix.browserify('month.js', './public/js/monthBundle.js');
    // Concatenate All Front End Script Files
    mix.scripts([
        "bootstrap/dist/js/bootstrap.min.js",
        "underscore/underscore.js",
        "moment/moment.js",
        "clndr/src/clndr.js",
        "vue/dist/vue.min.js",
        "vue-resource/dist/vue-resource.min.js"
    ],"./public/front/js/front.js","./resources/vendor");

});
