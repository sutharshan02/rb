
'use strict';
var app = angular.module('myapp', ['ngRoute','ngStorage', 'ngAnimate', 'ui.bootstrap', 'ngMessages', 'ngMediaQuery', 'ngSanitize']);

var _template_id = null;
var _resume_id = null;
var _cvdata = null;
// local
app.constant('config', {
    // _base_url: 'http://localhost/rb_view/',
    _api_url: app_url,
    _views_url: app_url+'/rb_views/',

  });

// nginx
// app.constant('config', {
//     // _base_url: 'http://localhost/rb_view/',
//     _api_url: 'http://localhost:8000/',
//     _views_url: 'http://localhost:8000/rb_views/',

//   });


// live
// app.constant('config', {
//     // _base_url: 'http://localhost/rb_view/',
//     _api_url: 'http://careers.825mediatesting.com/',
//     _views_url: 'http://careers.825mediatesting.com/rb_views/',

//   });

// app.factory('config', function(){
//   var config = {};
//   config.type = "dev"
//   config.setType = function() {
//     switch(config.type) {
//       case "dev":
//         config._api_url ='http://localhost/resume_builder/public/';
//         config._views_url = 'http://localhost/resume_builder/public/rb_views/';
//         break;

//     }
//   }

//   config.setType();
//   return config;
// })

app.config(function($sceProvider, $routeProvider, config, $locationProvider){

  // $locationProvider.html5Mode(true);

  $routeProvider.when("/",
  {
    templateUrl: config._views_url + "step1.html?113",
    controller: "ResumeController",
    controllerAs: "app"
  }
  );

  $routeProvider.when("/edit",
  {
    templateUrl: config._views_url + "step1.html?131",
    controller: "ResumeController"
  }
  );

  $routeProvider.when("/step2",
  {
    templateUrl: config._views_url + "step2.html?131",
    controller: "ResumeController"
  });


  $routeProvider.when("/step3",
  {
    templateUrl: config._views_url + "step3.html?131",
    controller: "WorkController",
    controllerAs: "app"
  });


  $routeProvider.when("/step4",
  {
    templateUrl: config._views_url + "step4.html?131",
    controller: "EducationController",
    controllerAs: "app"
  });


  $routeProvider.when("/step5",
  {
    templateUrl: config._views_url + "step5.html?131",
    controller: "skillController",
    controllerAs: "skillCtrl"
  });

  $routeProvider.when("/step6",
  {
    templateUrl: config._views_url + "step6.html?131",
    controller: "saveController",
    controllerAs: "saveCtrl"
  });

  $routeProvider.when("/all",
  {
    templateUrl:  config._views_url + "view_all.html?232",
    controller: "AppCtrl",
    controllerAs: "app"
  });


  $routeProvider.when("/template",
  {
    templateUrl: config._views_url + "selectTemplate.html?43",
    controller: "templateController",
    controllerAs: "temp"
  });

    $routeProvider.when("/template1",
  {
    templateUrl: config._views_url + "old-selectTemplate.html",
    controller: "templateController",
    controllerAs: "temp"
  });


  $routeProvider.when("/error",
  {
    templateUrl: config._views_url + "error.html",
    controller: "AppCtrl",
    controllerAs: "app"
  });

  $routeProvider.when("/verify",
  {
    templateUrl: config._views_url + "verify_email.html",
    controller: "verifyCtrl",
    controllerAs: "verify"
  });




});

app
.service('lang', function(){
  var lang = this;
  lang.email_error = "Please enter the require fields";


  return lang;

});

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

app.controller('homeCtrl', function(env, $scope, $localStorage, $sessionStorage, $http, config, $location, $window){

 env.devlog('resume id' + $localStorage.resume_id)
  delete $sessionStorage.work_id;
    delete $sessionStorage.resume_id;
    delete $sessionStorage.education_id;
   env.devlog('resume id delted' + $localStorage.resume_id)
  
})
 
app.service('cvData', function($http, $sessionStorage, config, env) {

  var cvData = {};

  
  // update controller scope on demand
  // @input $scope
  cvData.updateScope = function(scope) {
console.log("Template id:"+$sessionStorage.template_id);
  console.log("resume id:"+$sessionStorage.resume_id);
  console.log($sessionStorage.cvdata);

  if($sessionStorage.template_id != null) {
    $sessionStorage.template_id = 1;
  }
    // clearing existing data
    scope.months = [
{'id': '01', 'name' : 'Jan'},
{'id': '02', 'name' : 'Feb'},
{'id': '03', 'name' : 'March'},
{'id': '04', 'name' : 'April'},
{'id': '05', 'name' : 'May'},
{'id': '06', 'name' : 'Jun'},
{'id': '07', 'name' : 'July'},
{'id': '08', 'name' : 'August'},
{'id': '09', 'name' : 'September'},
{'id': '10', 'name' : 'October'},
{'id': '11', 'name' : 'November'},
{'id': '12', 'name' : 'December'}
];


  // create years object
  scope.years = [];
  (function(){
    var maxExperience = 30;
    var yearRangeEnd = 2019;
    var yearRangeStart = yearRangeEnd - maxExperience;
    for(var i = yearRangeStart; i < yearRangeEnd; i++) {
      scope.years.push({
        'id': i,
        'name': i
      });
    }
  })();
    scope.resume = {};
    scope.work = {};
    scope.education = {};
    scope.skills = [];


    function match(category) {
      return function(x){
        return x.id == category;
      }
    }
    scope.cvData =  $sessionStorage.cvdata;
    if(scope.cvData==null)
    {
        scope.loading = false;
        return;
    }
      scope.resume = scope.cvData.personal;

      scope.resume.preview_template_id = $sessionStorage.template_id;
      scope.work = scope.cvData.work;
      scope.education = scope.cvData.education;
      //scope.skills = scope.cvData.skills;
            if(scope.cvData.skills != null){
              scope.skillsList = (scope.cvData.skills).split(',')
            }
            $sessionStorage.template_id = scope.cvData.personal.template_id;


            // replacing view steps scope values;
            scope.jobs = scope.work;
            scope.schools = scope.education;

              // fixing skills 
              if(scope.skillCtrl) {
                if(scope.skills){

                  console.log('loading skills');
                  console.log(scope.skills);
                  if(scope.cvData.skills != "") {

                    scope.skills = scope.cvData.skills.split(',');
                  }
                  else {
                    scope.skills = [];
                  }
                }
              }

              // fixing the dates for ng-options in work
              if(scope.months) {
                if(env.ifDev()){

                  console.log('work data is loaded');
                }
                // adjusting work data
                angular.forEach(scope.work, function(key, value) {
                   console.log(scope.work[value]);
                   console.log('value : ' + value + " \n key : " + key);
                  // console.log(key);
                  scope.work[value].start_year_text = scope.years.filter(match(scope.work[value].start_year))[0];
                  scope.work[value].start_month_text = scope.months.filter(match(scope.work[value].start_month))[0];

                  scope.work[value].end_year_text = scope.years.filter(match(scope.work[value].end_year))[0];
                  scope.work[value].end_month_text = scope.months.filter(match(scope.work[value].end_month))[0];

                  // adding closed
                  scope.work[value].closed = true;
                  scope.jobs = scope.work;
                });

                // adjusting education data
                angular.forEach(scope.education, function(key, value) {
                  // console.log(scope.education[value]);
                  // console.log('value : ' + value + " \n key : " + key);
                  // console.log(key);
                  scope.education[value].start_year_text = scope.years.filter(match(scope.education[value].start_year))[0];
                  scope.education[value].start_month_text = scope.months.filter(match(scope.education[value].start_month))[0];

                  scope.education[value].graduation_year_text = scope.years.filter(match(scope.education[value].graduation_year))[0];
                  scope.education[value].graduation_month_text = scope.months.filter(match(scope.education[value].graduation_month))[0];

                  // adding closed
                  scope.education[value].closed = true;
                  scope.schools = scope.education;
                });
              }
            }
        return cvData;

      });



