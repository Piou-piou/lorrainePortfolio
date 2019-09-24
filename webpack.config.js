var Encore = require('@symfony/webpack-encore');

Encore
  .enableSingleRuntimeChunk()
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  /*.cleanupOutputBeforeBuild()*/

  .addStyleEntry('css/style', './assets/scss/style.scss')

  .addStyleEntry('css/fine-uploader', [
    './node_modules/fine-uploader/fine-uploader/fine-uploader-gallery.min.css',
    './assets/scss/fine-uploader.scss',
  ])

  .addEntry('js/upload', [
    './assets/js/upload.js',
  ])

  .createSharedEntry('vendor', './webpack.shared_entry.js')

  .configureBabel(function(babelConfig) {
  }, {
    includeNodeModules: ['ribs-core']
  })

  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  // enables Sass/SCSS support
  .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();
