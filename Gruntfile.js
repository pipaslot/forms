module.exports = function (grunt) {
    grunt.initConfig({
        concat: {
            css: {
                src: ['media/src/css/*.css'],
                dest: 'media/dist/forms.css'
            },
            js: {
                src: ['media/src/js/*.js'],
                dest: 'media/dist/forms.js'
            }           
        },
        uglify: {
            allJs: {
                files: [{
                    expand: true,
                    src: ['**/*.js', '!**/*.min.js'],
                    cwd: 'media/dist',
                    dest: 'media/dist',
                    ext: '.min.js'
                }]
            }
        },
        cssmin: {
            allCss: {
                files: [{
                    expand: true,
                    src: ['**/*.css', '!**/*.min.css'],
                    cwd: 'media/dist',
                    dest: 'media/dist',
                    ext: '.min.css'
                }]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['concat', 'uglify', 'cssmin']); // Default grunt tasks maps to grunt
};