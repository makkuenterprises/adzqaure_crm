let mix = require('laravel-mix');

mix.js("resources/js/web/app.js", "public/web/js")
    .postCss("resources/css/web/app.css", "public/web/css", [
    require("tailwindcss"),
]);

mix.js("resources/js/admin/app.js", "public/admin/js")
    .postCss("resources/css/admin/app.css", "public/admin/css", [
    require("tailwindcss"),
]);

mix.js("resources/js/employee/app.js", "public/employee/js")
    .postCss("resources/css/employee/app.css", "public/employee/css", [
    require("tailwindcss"),
]);