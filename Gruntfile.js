'use strict';

module.exports = function(grunt) {
 
grunt.loadNpmTasks('grunt-sass');
 
grunt.initConfig({
    sass: {
        options: {
            sourceMap: true
        },
        dist: {
            files: {
                'templates/selfsign01/css/sswu.css': ['templates/selfsign01/bootflat/scss/bootflat.scss']
            }
        }
    }
});
 
grunt.registerTask('default', ['sass']);
};
