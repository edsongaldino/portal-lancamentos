const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copy('resources/js/site/empreendimento/proposta.js', 'public/site/js/empreendimento/proposta.js');
mix.copy('resources/js/site/home/newsletter.js', 'public/site/js/home/newsletter.js');
