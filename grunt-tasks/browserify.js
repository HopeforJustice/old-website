module.exports = function (distTheme, devTheme, jsDir) {
	return {
	    build: {
	        src: devTheme + jsDir + 'scripts.js',
	        dest: devTheme + jsDir + 'scripts-bundle.js'
	    }
	}
}