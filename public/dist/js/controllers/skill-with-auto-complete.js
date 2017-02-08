

app.controller('skillController', function(Page, env, $scope, $localStorage, $sessionStorage, $http, config, $location, cvData){
  Page.setTitle('Step 5 - Skills')

  $scope.preview_template_id = 3;

  env.type = 'prod';
  $scope.showLoader = function() {
    $scope.loading = true;
  }

  $scope.hideLoader = function() {
    $scope.loading = false;
  }
$scope.skillCtrl = true;
$scope.template_id = $sessionStorage.template_id;

  
  $scope.skills = [];

  $scope.one ='addd';
  $scope.resume_id = $sessionStorage.resume_id;


  $scope.testIt = function() {
  }



// http://localhost/resume_builder/public/userskill?skill=
function loadDefinedSkills() {
  $http({
    method: 'GET',
    url: config._api_url + 'userskill?skill='
  }).then(function successCallback(response) {
          // this callback will be called asynchronously
          // when the response is available
          var res = response.data.data;
          $scope.setSkills = res;
          $scope.allSkills = res;
        }, function errorCallback(response) {
          loadDefinedSkills();

        });
  }

  loadDefinedSkills();


     // Triggering the jquery ui autocomplete component
     $scope.autoInput = function() {
        // updateList();
        // angular.element('searchInputField').autocomplete();
        angular.element("#searchInputField").autocomplete({
          source: function(request, response) {
            
            var results = angular.element.ui.autocomplete.filter($scope.setSkills, request.term);
                  // response(results.slice(0, 5));
                  var text = "one,two,three,four,five,six,seven,eight,nine";
            // results = text.split(',');
            response(results);
          },
          change: function (event, ui) {
          }
          
        });

      }


      // Triggered when add button is clicked
      $scope.shouldCreate = false;
      $scope.addItem = function() {
        
        env.devlog($scope);
        env.devlog(typeof $scope.skills == "undefined");
        if (typeof $scope.skills == "undefined") {
          $scope.skills = [];
          $scope.shouldCreate = true;
        }
        
        var allSkills  = $scope.setSkills;
        var text = angular.element('#searchInputField').val();


        var inSet = (allSkills.indexOf(text) >= 0);

        var inSkills = $scope.skills ? ($scope.skills.indexOf(text) >= 0) : false;
        
        if(inSet && !inSkills) {
          $scope.skills.push(text);
        }

        if(inSkills) {
          alert('You have already added this skill');
          $scope.loading = false;
        }

        if(!inSet) {
          alert('Please select a skill from on of the suggestions');
          $scope.loading = false;
        }

          createNewEntry();

        $scope.searchKey = "";

      }


      // Triggered when closing a tag from selected skills 
      $scope.removeSkill = function(item) {
        $scope.skills = $scope.skills.filter(function(x){
          return x != item;
        });
        createNewEntry();
      }

    
  function createNewEntry() {
    $scope.showLoader();
   var data = {
    'skills' : $scope.skills.toString()
  };
  $http({
    method: 'POST',
    data: data,
    url: config._api_url + 'step/skill'
  }).then(function successCallback(response) {
                $sessionStorage.cvdata = response.data.resume_data.result;
                cvData.updateScope($scope);
                $scope.loading = false;
              }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                $scope.loading = false;

              });

}

  $scope.nextStep = function() {
   $location.path("step6");
 }


     // handling preview modal
     
     previewOpen = false;
     $scope.openPreview = function() {
      $scope.previewOpen = true;
      $scope.modalOpenStyle = {'display':'block'};
      angular.element('body').addClass('modal-open');
    }


    $scope.closePreview = function() {
      $scope.previewOpen = false;
      $scope.modalOpenStyle = "{}";
      angular.element('body').removeClass('modal-open');
    }


   $scope.nextStep = function() {
      $scope.showLoader();
    
      $location.path("template");

    }

  cvData.updateScope($scope);

});




