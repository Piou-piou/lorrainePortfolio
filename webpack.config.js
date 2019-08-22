var Encore = require('@symfony/webpack-encore');

Encore
  .enableSingleRuntimeChunk()
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()

  .addStyleEntry('css/style', './assets/scss/style.scss')

  .addEntry('js/ribs-nav', './assets/js/ribs-nav.js')

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