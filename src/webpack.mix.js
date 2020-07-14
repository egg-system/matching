const mix = require('laravel-mix')
const glob = require('glob');

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

mix.webpackConfig({ plugins: [ new VuetifyLoaderPlugin()] });
mix.js('resources/js/app.js', 'public/js');

/**
 * scssのコンパイル用パス自動マッピング
 */
const scssPath = 'resources/scss/';
const searchScss = '/scss';
const publicPath = 'public/';
glob.sync(`${scssPath}/**/*.scss`).map(function(file) {

    //ファイルパスから/scssの位置を検索
    const index   = file.indexOf(searchScss);

    //基準文字列から後の文字列を切り出して表示
    const dir = file.slice(index + 1);
    const dir_path = dir.split("/").reverse().slice(1).reverse().join("/");
    const css_path = dir_path.replace('scss', 'css');

    // マッピングパスを動的に生成
    mix.sass(file, publicPath + css_path);
});
