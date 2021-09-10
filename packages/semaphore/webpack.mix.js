const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('public')
    .ts('resources/ts/app.ts', 'public/js').vue()
    .postCss('resources/scss/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .copyDirectory('resources/images', 'public/images', false);

mix.webpackConfig({
    resolve: {
        alias: {
            '@root': path.resolve(__dirname, '')
        }
    }
});