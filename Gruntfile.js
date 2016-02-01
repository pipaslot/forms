module.exports = function (grunt) {
    grunt.initConfig({
        uglify: {
            allJs: {
                files: [{
                    expand: true,
                    src: ['**/*.js', '!**/*.min.js'],
                    cwd: 'media',
                    dest: 'media',
                    ext: '.min.js'
                }]
            }
        },
        cssmin: {
            allCss: {
                files: [{
                    expand: true,
                    src: ['**/*.css', '!**/*.min.css'],
                    cwd: 'media',
                    dest: 'media',
                    ext: '.min.css'
                }]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['uglify', 'cssmin']); // Default grunt tasks maps to grunt
};