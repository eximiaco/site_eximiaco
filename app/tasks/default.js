/**
 * Build for development environment
 *
 * @param {object} grunt The Grunt object.
 */
module.exports = function ( grunt ) {
	grunt.task.registerTask( 'default', [
		'clean',
		'stylint',
		'jshint',
		'stylus:dev',
		'symlink'
	] );
};
