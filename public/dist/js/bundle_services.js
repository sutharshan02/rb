app
.service('env', function(){
	var env = this;
		env.type = 'dev';
		env.ifDev = function() {
			// return (env.type == 'dev');
			return false
		}

		env.devlog = function(msg){

			if(env.type == 'dev') {
				console.log(msg);
			}
		}
	return env;
});
app
.service('lang', function(){
	var lang = this;
	lang.email_error = "Please enter the require fields";


	return lang;

});