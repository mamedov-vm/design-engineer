const mix = require('laravel-mix');

mix.js('resources/_Vue/app.js', 'public/js')
   // .sass('resources/js/app.scss', 'public/css')
   .vue({version: 3});
