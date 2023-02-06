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

/*
 |--------------------------------------------------------------------------
 | VENDOR CSS
 |--------------------------------------------------------------------------
*/ 
mix.styles(['resources/admin/app-assets/vendors/css/vendors.min.css'], 'public/css/vendor/vendors.min.css'); 
mix.styles(['resources/admin/app-assets/vendors/css/animate/animate.css'], 'public/css/vendor/animate.css'); 
mix.styles(['resources/admin/app-assets/vendors/css/extensions/sweetalert2.min.css'], 'public/css/vendor/sweetalert2.min.css');
mix.styles(['resources/admin/app-assets/vendors/css/extensions/swiper.min.css'], 'public/css/vendor/swiper.min.css');

/*
 |--------------------------------------------------------------------------
 | THEME CSS
 |--------------------------------------------------------------------------
*/
mix.styles(['resources/admin/app-assets/css/bootstrap.css'], 'public/css/theme/bootstrap.css');
mix.styles(['resources/admin/app-assets/css/bootstrap-extended.css'], 'public/css/theme/bootstrap-extended.css');
mix.styles(['resources/admin/app-assets/css/colors.css'], 'public/css/theme/colors.css');
mix.styles(['resources/admin/app-assets/css/components.css'], 'public/css/theme/components.css');
mix.styles(['resources/admin/app-assets/css/themes/dark-layout.css'], 'public/css/theme/dark-layout.css');
mix.styles(['resources/admin/app-assets/css/themes/semi-dark-layout.css'], 'public/css/theme/semi-dark-layout.css');
mix.styles(['resources/admin/app-assets/css/plugins/forms/validation/form-validation.css'], 'public/css/theme/form-validation.css');
mix.styles(['resources/admin/app-assets/vendors/css/forms/select/select2.min.css'], 'public/css/theme/select2.min.css');
/*
 |--------------------------------------------------------------------------
 | PAGE CSS
 |--------------------------------------------------------------------------
*/
mix.styles(['resources/admin/app-assets/css/core/menu/menu-types/vertical-menu.css'], 'public/css/page/vertical-menu.css');
mix.styles(['resources/admin/app-assets/css/pages/authentication.css'], 'public/css/page/authentication.css'); 
mix.styles(['resources/admin/app-assets/css/core/menu/menu-types/vertical-menu.css'], 'public/css/page/vertical-menu.css'); 
mix.styles(['resources/admin/app-assets/css/pages/search.css'], 'public/css/page/search.css'); 
mix.styles(['resources/admin/app-assets/css/plugins/extensions/swiper.css'], 'public/css/page/swiper.css'); 

/*
 |--------------------------------------------------------------------------
 | CUSTOM CSS
 |--------------------------------------------------------------------------
*/
mix.styles(['resources/admin/assets/css/style.css'], 'public/css/custom/style.css');

// ------------------------------------------------------------------------------------------------- //

// --------------------------- 
/*
 |--------------------------------------------------------------------------
 | VENDOR JS
 |--------------------------------------------------------------------------
*/
mix.scripts(['resources/js/jquery-3.2.1.min.js'], 'public/js/jquery-3.2.1.min.js').version();
mix.scripts(['resources/admin/app-assets/vendors/js/vendors.min.js'], 'public/js/vendor/vendors.min.js').version();
/*
 |--------------------------------------------------------------------------
 | THEME JS
 |--------------------------------------------------------------------------
*/
mix.scripts(['resources/admin/app-assets/js/core/app-menu.js'], 'public/js/theme/app-menu.js').version();
mix.scripts(['resources/admin/app-assets/js/core/app.js'], 'public/js/theme/app.js').version();
mix.scripts(['resources/admin/app-assets/js/scripts/components.js'], 'public/js/theme/components.js').version();
mix.scripts(['resources/admin/app-assets/js/scripts/footer.js'], 'public/js/theme/footer.js').version();
/*
 |--------------------------------------------------------------------------
 | PAGE JS
 |--------------------------------------------------------------------------
*/
mix.scripts(['resources/admin/app-assets/vendors/js/forms/select/select2.full.min.js'], 'public/js/page/select2.full.min.js').version();
mix.scripts(['resources/admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js'], 'public/js/page/sweetalert2.all.min.js').version();
mix.scripts(['resources/admin/app-assets/vendors/js/extensions/polyfill.min.js'], 'public/js/page/polyfill.min.js').version();
mix.scripts(['resources/admin/app-assets/vendors/js/extensions/swiper.min.js'], 'public/js/page/swiper.min.js'); 
/*
 |--------------------------------------------------------------------------
 | CUSTOM JS
 |--------------------------------------------------------------------------
*/
mix.scripts(['resources/admin/app-assets/js/scripts/forms/select/form-select2.js'], 'public/js/custom/form-select2.js').version();
mix.scripts(['resources/admin/app-assets/js/scripts/pages/page-search.js'], 'public/js/custom/page-search.js').version();
mix.scripts(['resources/js/select_icon.js'], 'public/js/custom/select_icon.js').version();

/*
 |--------------------------------------------------------------------------
 | COPY DIRECTORY
 |--------------------------------------------------------------------------
*/
mix.copyDirectory('resources/admin/app-assets/fonts', 'public/fonts'); 
mix.copyDirectory('resources/admin/app-assets/images', 'public/img'); 
mix.copyDirectory('resources/admin/app-assets/data', 'public/data'); 