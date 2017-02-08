

app.controller('saveController', function(Page, $scope, $localStorage, $sessionStorage, $http, config, $location, cvData){
  
  $scope.preview_template_id = $sessionStorage.template_id;
  Page.setTitle('Save');
  $scope.checkMail = false;
  $scope.name_empty = false;

  $scope.save = function() {

          if($scope.resume.resume_name != '')
          {
               $scope.name_empty = false;
              updateResumeName(0);
              // alert('name entered');
          } else {
            $scope.name_empty = true;
            // alert('please enter a name');
          }
  }

  function updateResumeName(redirect) {
      $scope.loading = true;
    var data = {
      'resume_id' : $sessionStorage.resume_id,
      'resume_name': $scope.resume.resume_name

    };

    $http({
        method: 'POST',
        data: data,
        url: config._api_url + 'step/resume/save'
         }).then(function successCallback(response) {
        //scsses
        if(response.data.status_code == '0')
        {
            
                window.location = config._api_url + 'dashboard';
            
            $scope.loading = false;
        } 
        else 
        { 
            $scope.loading = false;
                 
        }
        }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
            $scope.loading = false;

        });
        
  }

 cvData.updateScope($scope);
});




