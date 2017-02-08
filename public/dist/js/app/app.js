app.factory('Page', function(){
  var title = '';
  return {
    title: function() { return title; },
    setTitle: function(newTitle) { title = newTitle; }
  };
});

app.controller('PageTitleController', function($scope, Page) {
  $scope.page = Page;
})

angular.module('myapp').value('media', {
    'xs': [-1, 767],
    'sm': [768, 991],
    'md': [992, 1199],
    'lg': [1200, -1]
});
app.controller('DeleteModalController', function ($scope, $modalInstance, deleteStatus) {
  $scope.ok = function () {
    $modalInstance.close($scope.deleteStatus = true);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss($scope.deleteStatus = false);
  };
});

app.controller('AppCtrl', function($window, $scope, $localStorage, $sessionStorage, $http, config, $location, $window, env , $modal, $log){



  // start modal code
  $scope.openDelete = function(id) {
    var deleteModal = $modal.open({
      templateUrl: 'deleteConfirmModal.html',
      controller: 'DeleteModalController',
      size: 'lg',
      resolve: {
        deleteStatus: function () {
          return $scope.deleteStatus;
        }
      }
    });

    deleteModal.result.then(function(answer) {
      if(answer) {

        $scope.delete(id);
      } else {

      }
    })

  }
  // end modal code


  $scope.showingVerify = false;
  $scope.clog = "";

  
  console.log(config._api_url + 'resume/create#//');
  console.log('app controller loaded');

  // if($sessionStorage.user_id) {
  //   $scope.clog = "session has a user";
  //   // check whether verified
  //   var promise = $http.get(config._api_url + 'user/isverified?user_id=' + $sessionStorage.user_id);
  //   promise.then(
  //     function(res){
  //       console.log(res.data.data.verified);
  //       if(res.data.data.verified != 1) {
  //         //  first time check for new users
  //         $window.location.href = config._api_url + "resume/create#/verify";
  //       }
  //     }
  //     )



  // } else {
  //   $scope.clog = "session has no user";
  //    if($sessionStorage.resume_id) {
  //     // second time check for new users
  //   $scope.clog = $scope.clog + " \n session has a resume id";
  //       $window.location.href = config._api_url + "resume/create#/verify";
  //    } else {
  //   $scope.clog = $scope.clog + " \n session has a resume id";

  //       $window.location.href = config._api_url;
  //    }
  // }

  // console.log($scope.clog);


  delete $sessionStorage.resume_id;
  $sessionStorage.template_id = 5;
    
  // load the list of cv's for the user if available
  init = function() {

$scope.loading = true;
var promise = $http.get(config._api_url + 'resume/all?user_id=' + $sessionStorage['user_id']);
promise.then(
  function(response){
    $scope.resumes = response.data.data;
  },
  function(error) {
        // console.log(error);
        $scope.loadingError = true;
      },
      function(loading) {
        $console.log('loading');
      }

      ).finally(function(){

        $scope.loading = 0;
      });
}
init();


  // edit cv
  $scope.edit = function(id, template_id) {
    $sessionStorage.resume_id = id;
    $sessionStorage.template_id = template_id;
    $location.path("/");
  }


  // create new cv
  $scope.create = function() {
    delete $sessionStorage.resume_id;
    $sessionStorage.template_id = 1;
    $location.path("/template");
  }



  $scope.delete = function(id) {


    $scope.resume_id = id;
    console.log('deleting');
    $http({
      method: 'GET',
      url: config._api_url + 'delete/resume?resume_id=' + id
    }).then(function successCallback(response) {
        // this callback will be called asynchronously
        // when the response is available
        
        // angular.element('#cv-item-' + $scope.resume_id).remove();
        $window.location.reload();

        init();
      }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
      });
  
}

  $scope.download = function(resume_id, template_id) {
    user_id = $sessionStorage.user_id;
    // $locationProvider.html5Mode(true);
    $location.path('/a')
  }


});


