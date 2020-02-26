/**
 * The RequireJS config file.
 *
 * Config the app and libs paths. The libs is automagically loaded with the
 * grunt-bower task.
 */

var require = {
    config: function (c) {
        require = c;
    }
};

/* globals elemarjr_script_config */
require.config({
    baseUrl: elemarjr_script_config.base_url,
    paths: {
        app: '../app'
    },
    deps: ['app']
});
