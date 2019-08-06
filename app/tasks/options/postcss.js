/**
 * Compile stylus file
 */
module.exports = {
	options: {
		annotation: false,
		processors: [
			require('cssnano')({
				preset: ['default', {
					discardComments: {
						removeAll: true,
					},
				}]
			})
		],
	},
	dist: {
		files: {
			'<%= config.assets.build %>/css/style.css' : '<%= config.assets.build %>/css/style.css'
		}
	},
};
