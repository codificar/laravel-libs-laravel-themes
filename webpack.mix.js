const mix = require('laravel-mix');
const webpack = require('webpack');

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

mix.options({})
	.setPublicPath('public')
	.js('src/resources/js/app.js', 'public/js')
	.version()
	.webpackConfig({
		resolve: {
			symlinks: false,
			alias: {
				'@': path.resolve(__dirname, 'resources/js/'),
			},
		},
		plugins: [new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)],
	});