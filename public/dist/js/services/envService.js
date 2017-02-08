app
.service('env', function(){
	var env = this;
		env.type = 'prod';
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