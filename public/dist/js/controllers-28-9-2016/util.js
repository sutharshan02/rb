'use strict';
var app = angular.module('myapp', ['ngRoute','ngStorage', 'ngAnimate']);


// local
// app.constant('config', {
//     // _base_url: 'http://localhost/rb_view/',
//     _api_url: 'http://localhost/resume_builder/public/',
//     _views_url: 'http://localhost/resume_builder/public/rb_views/',

//   });


// live
app.constant('config', {
    // _base_url: 'http://localhost/rb_view/',
    _api_url: 'http://careers.825mediatesting.com/',
    _views_url: 'http://careers.825mediatesting.com/rb_views/',

  });

app.config(function($routeProvider, config, $locationProvider){

  // $locationProvider.html5Mode(true);

  $routeProvider.when("/",
  {
    templateUrl: config._views_url + "step1.html",
    controller: "ResumeController",
    controllerAs: "app"
  }
  );

  $routeProvider.when("/a",
  {
    templateUrl: config._views_url + "step1.html",
    controller: "ResumeController",
    controllerAs: "app"
  }
  );

  $routeProvider.when("/step2",
  {
    templateUrl: config._views_url + "step2.html",
    controller: "ResumeController",
    controllerAs: "app"
  });


  $routeProvider.when("/step3",
  {
    templateUrl: config._views_url + "step3.html",
    controller: "WorkController",
    controllerAs: "app"
  });


  $routeProvider.when("/step4",
  {
    templateUrl: config._views_url + "step4.html",
    controller: "EducationController",
    controllerAs: "app"
  });


  $routeProvider.when("/step5",
  {
    templateUrl: config._views_url + "step5.html",
    controller: "skillController",
    controllerAs: "skillCtrl"
  });

  $routeProvider.when("/step6",
  {
    templateUrl: config._views_url + "step6.html",
    controller: "saveController",
    controllerAs: "saveCtrl"
  });

  $routeProvider.when("/all",
  {
    templateUrl: config._views_url + "view_all.html",
    controller: "AppCtrl",
    controllerAs: "app"
  });

  $routeProvider.when("/error",
  {
    templateUrl: config._views_url + "error.html",
    controller: "AppCtrl",
    controllerAs: "app"
  });




});


app.controller('homeCtrl', function($scope, $localStorage, $sessionStorage, $http, config, $location, $window){

 console.log('resume id' + $localStorage.resume_id)
  delete $sessionStorage.work_id;
    delete $sessionStorage.resume_id;
    delete $sessionStorage.education_id;
   console.log('resume id delted' + $localStorage.resume_id)
  
})
 


