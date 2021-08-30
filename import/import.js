'use strict'

import Importer from './importer.js'

const timeout = (process.env.npm_config_timeout) ? process.env.npm_config_timeout : 3000
Importer.processNotifyTemplate(process.env.npm_config_file, timeout)

const showStats = () => {
  console.log('Import script has completed.')
  console.log(Importer.importCount.success, 'successful imports')
  console.log(Importer.importCount.skipped, 'skipped imports')
  console.log(Importer.importCount.failure, 'failed imports')
}
process.on('exit', () => { showStats() })
process.on('SIGINT', () => {
  process.exit(0)
})
