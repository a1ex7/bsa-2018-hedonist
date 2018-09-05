'use strict'
const merge = require('webpack-merge')
const prodEnv = require('./prod.env')

module.exports = merge(prodEnv, {
    NODE_ENV: '"development"',
    MAPBOX_TOKEN: '"'+process.env.MAPBOX_TOKEN+'"',
    MAPBOX_STYLE: '"'+process.env.MAPBOX_STYLE+'"',
    PUSHER_APP_KEY: '"'+process.env.PUSHER_APP_KEY+'"',
    PUSHER_APP_CLUSTER: '"'+process.env.PUSHER_APP_CLUSTER+'"',
    APP_EVENTS_NAMESPACE: '"'+process.env.APP_EVENTS_NAMESPACE+'"',
});