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

app.controller('templateController', function(Page, NgMediaQuery, $scope, $localStorage, $sessionStorage, $http, config, $location,cvData, env) {
	$scope.preview_template_id = $sessionStorage.template_id;
	console.log($sessionStorage);
	Page.setTitle("Select Template");
	$scope.selected_template = '';
	$scope.template_id = $sessionStorage.template_id;
	$scope.selected_template = $sessionStorage.template_id;
	console.log('session template', $sessionStorage.template_id);
	console.log('selected template', $scope.selected_template);
	// $scope.init = function(){

	// 	$http.get(config._api_url + 'get/allcvdata')
	// 	.then(function success(response){
	// 		console.log('got data', response);
	// 		console.log("template id =", response.data.result.personal.template_id);
	// 		$scope.selected_template.id = $sessionStorage.template_id;
	// 		  if(!$scope.$$phase) {
 //              //$digest or $apply
 //                $scope.$apply();
 //              }

	// 	}, function error(){
	// 		alert('didnt get data')
	// 	})
	// }

	// $scope.init();
	$scope.imgPath = config._api_url;
	if(env.ifDev()){
	console.log('template controller loaded');

	}
	$scope.start = function(template_id) {
		$sessionStorage.template_id = $scope.template_id;
		$location.path("/step6");
	}	




	$scope.gotoSave = function() {

	

		var data = {
			'template_id' : $scope.template_id
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
		}
		,	{
			id: 6,
			name: 'Professional',
			order: 6
		}
		,	{
			id: 7,
			name: 'New',
			order: 7
		}

	];
	console.log($scope.templates);

	$scope.select = function(id){

		$scope.showPreview = true;
		$scope.updateID = id;

	
		console.log('clicked again' + id);
		$scope.selected_template = id;
		$sessionStorage.template_id = id;
		$scope.template_id = id;


	}


	var breakpoints = {
    $mq_small: "screen and (min-width: 992px)"
};



$scope.mobile = function(){
		var getMedia = NgMediaQuery.getMedia();        
		getMedia.then(function(data){
			console.log(data);
	   if (data == 'xs' || data == 'sm'){
	   	return true;
	   } else {
	   	return false;
	   }
		}, function(status){
    //  this returns the current media value, initial setting can be set here
   });
}

$scope.closePreview = function() {
	console.log('closing preview');

	$scope.showPreview = false;

}

$scope.setPreview = function(){
		var getMedia = NgMediaQuery.getMedia();        
		getMedia.then(function(data){
			console.log(data);
	   if (data == 'xs' || data == 'sm'){
	   	$scope.showPreview = false;
	   } else {
	   	$scope.showPreview = true;
	   }
		}, function(status){
    //  this returns the current media value, initial setting can be set here
   });
}

$scope.setPreview();

 // $scope.showPreview = false;

	
});
