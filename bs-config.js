const urlapi = require('url');
const siteUrl = 'https://dcannabiscentr.wpenginepowered.com/', // example `https://site-url.com/`
	themeName = 'cannabiscentral'; // example `project-name`. Theme name should not have spaces!!!
const URL = urlapi.parse(siteUrl);

module.exports = {
	files: ["assets/css/*.css","*.php", "parts/**/*.php", "templates/*.php", "assets/js/global.js"],
	proxy: siteUrl,
	serveStatic: ["./"],
	reloadDelay: 1000,

	rewriteRules: [
		{
			match: new RegExp( URL.path.substring(1) + "wp-content/themes/" + themeName + "/assets",'g' ),
			fn: function () {
				return "assets"
			}
		}
	],
};