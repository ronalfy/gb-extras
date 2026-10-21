module.exports = function( grunt ) {
	grunt.initConfig( {
		compress: {
			main: {
				options: {
					archive: 'mediaron-block-shortcuts-for-gb.zip',
				},
				files: [
					{ src: [ 'mediaron-block-shortcuts-for-gb.php' ], dest: '/', filter: 'isFile' }, // includes files in path
					{ src: [ 'readme.txt' ], dest: '/', filter: 'isFile' },
					{ src: [ 'assets/**' ], dest: '/' }, // includes files in path and its subdirs
					{ src: [ 'php/**' ], dest: '/' }, // includes files in path and its subdirs
					{ src: [ 'lib/**' ], dest: '/' }, // includes files in path and its subdirs
					{ src: [ 'dist/**' ], dest: '/' }, // includes files in path and its subdirs
					{ src: [ 'build/**' ], dest: '/' }, // includes files in path and its subdirs
				],
			},
		},
	} );
	grunt.registerTask( 'default', [ 'compress' ] );

	grunt.loadNpmTasks( 'grunt-contrib-compress' );
};
