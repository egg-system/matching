const custom = require('../node_modules/laravel-mix/setup/webpack.config.js')

module.exports = async ({ config }) => {
  return { ...config, module: { ...config.module, rules: custom.module.rules } }
}
