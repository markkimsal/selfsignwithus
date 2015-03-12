'use strict';

module.exports = function(grunt) {
 
grunt.loadNpmTasks('grunt-sass');
 
grunt.initConfig({
    sass: {
        options: {
            sourceMap: true,
			outputStyle: 'compressed'
        },
        dist: {
            files: {
                'templates/selfsign01/css/sswu.css': 'templates/selfsign01/bootflat/scss/bootflat.scss', 
                'templates/selfsign01/css/sswu-site.css': 'templates/selfsign01/scss/site-structure.scss'
            }
        }
    }
});
 
grunt.registerTask('default', ['sass']);
};
