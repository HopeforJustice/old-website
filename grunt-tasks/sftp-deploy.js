module.exports = function (deployBase, themeName) {
	return {
	  	'production': {
			auth: {
			host: 'hopeforjustice.sftp.wpengine.com',
			port: 2222,
			authKey: 'production'
		},
		cache: 'sftpcache.json',
		src: deployBase,
		dest: 'wp-content',
		exclusions: [deployBase + '/plugins', deployBase + '/uploads', deployBase + '/languages', deployBase + '/upgrade', '.ftppass', '.git', '.gitignore', 'node_modules', '.sass-cache', 'npm-debug.log', 'debug.log', '.DS_Store', '.sftpcache.json'],
		serverSep: '/',
		concurrency: 1,
		progress: true
		},

		'staging': {
			auth: {
			host: 'hopeforjustice.sftp.wpengine.com',
			port: 2222,
			authKey: 'staging'
		},
		cache: 'sftpcache-staging.json',
		src: deployBase,
		dest: 'wp-content',
		exclusions: [deployBase + '/plugins', deployBase + '/uploads', deployBase + '/languages', deployBase + '/upgrade', '.ftppass', '.git', '.gitignore', 'node_modules', '.sass-cache', 'npm-debug.log', 'debug.log', '.DS_Store', '.sftpcache.json'],
		serverSep: '/',
		concurrency: 1,
		progress: true
		}
	}
}
