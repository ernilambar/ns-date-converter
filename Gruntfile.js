module.exports = function(grunt) {
	'use strict';

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		replace : {
			main: {
				options: {
					patterns: [
						{
							match: /Version:\s?(.+)/gm,
							replacement: 'Version: <%= pkg.version %>'
						}
					]
				},
				files: [
					{
						expand: true, flatten: true, src: ['<%= pkg.main_file %>'], dest: './'
					}
				]
			},
			class: {
				options: {
					patterns: [
						{
							match: /define\( \'NS_DATE_CONVERTER_VERSION\'\, \'(.+)\'/gm,
							replacement: "define( 'NS_DATE_CONVERTER_VERSION', '<%= pkg.version %>'"
						}
					]
				},
				files: [
					{
						expand: true, flatten: true, src: ['<%= pkg.main_file %>'], dest: './'
					}
				]
			}
		}
	});

	grunt.loadNpmTasks('grunt-replace');

	grunt.registerTask('version', ['replace:main', 'replace:class']);
};
