
const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js").postCss(
    "resources/css/app.css",
    "public/css",
    [require("postcss-import"), require("tailwindcss")]
);

if (mix.inProduction()) {
    mix.version();
}
mix.copyDirectory(
    "node_modules/grapesjs/dist",
    "public/grapesjs"
);

mix.copyDirectory(
    "node_modules/grapesjs-plugin-ckeditor/dist",
    "public/grapesjs-plugin-ckeditor"
);

mix.copyDirectory(
    "node_modules/grapesjs-preset-webpage/dist",
    "public/grapesjs-preset-webpage"
);

mix.copyDirectory(
    "node_modules/grapesjs-tabs/dist",
    "public/grapesjs-tabs"
);