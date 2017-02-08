// owl carousel directive
app.directive('owl', function(){
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			var options = scope.$eval($(element).attr('data-options')); 
			$(element).owlCarousel(options);

		}
	}
});

app.controller('templateController', function($scope, $localStorage, $sessionStorage, $http, config, $location,cvData, env) {


	$scope.imgPath = config._api_url;
	if(env.ifDev()){
	console.log('template controller loaded');

	}
	$scope.start = function(template_id) {
		$sessionStorage.template_id = template_id;
		$location.path("/step6");
	}	

	$scope.selected_template = {};
	$scope.selected_template.id = 3;


	$scope.gotoSave = function() {

		var data = {
			'template_id' : $scope.selected_template.id
		}

		// update template id
		$http({
			method: 'post',
			data: data,
			url: config._api_url + 'update/template'
		}).then(successUpdateTemplate, errorUpdateTemplate)


		function successUpdateTemplate(res) {
			console.log(res);

			if(res.data.status_code == 0) {
				$location.path("/step6");
			} else if( res.data.status_code == 1) {
				alert('please select a template');
			} else {
				alert('please select and submit again');
			}
		}

		function errorUpdateTemplate(res) {
			alert('server error please try again');
		}

	}


	$scope.templates = [
		{
			id: 1,
			name: 'Contemporary',
			order: 1
		},	{
			id: 2,
			name: 'Traditional',
			order: 2
		},	{
			id: 3,
			name: 'Modern',
			order: 3
		},	{
			id: 4,
			name: 'Classic',
			order: 4
		},	{
			id: 5,
			name: 'Executive',
			order: 5
		},	{
			id: 6,
			name: 'Professional',
			order: 6
		}

	];
	console.log($scope.templates);


	$scope.select = function(id){
		console.log('clicked again' + id);
		$scope.selected_template.id = id;
		console.log($scope.selected_template);
	}

	
});
