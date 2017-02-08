

app.controller('AppCtrl2', function($scope, $localStorage, $sessionStorage, $http, config, $location, $window){


    angular.element('#homeButton').click(function(){
    $scope.resume = [];

    delete $sessionStorage.resume_id;
  });

  var self = this;
  self.message = "The app routing is working";

  init = function() {
    $http({
      method: 'GET',
        url: config._api_url + 'resume/all?user_id=' + $sessionStorage['user_id']
        // url: 'http://localhost/resume_builder/public/resume/all?user_id=1'
      }).then(function successCallback(response) {
      // this callback will be called asynchronously
      // when the response is available
        $scope.resumes = response.data.data;
        $scope.loadingError = false;
      }, function errorCallback(response) {
        $scope.loadingError = true;
      });
  }



  init();
  $scope.download = function(){
    alert('adsf');
  }

  $scope.edit = function(id) {
    $sessionStorage.resume_id = id;
    $location.path("/");
  }

  $scope.create = function() {
    delete $sessionStorage.resume_id;
    $location.path("/");
  }


  $scope.delete = function(id) {
    $http({
    method: 'GET',
    url: config._api_url + 'delete/resume?resume_id=' + id
    }).then(function successCallback(response) {
        // this callback will be called asynchronously
        // when the response is available
        // $scope.init();
        initagain();
      }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
      });
  }

  function initagain() {
    $scope.init();
  }


});




app.controller('EducationController', function(env,$scope, $localStorage, $sessionStorage, $http, config, $location, cvData){

  env.type="dev";

  cvData.updateScope($scope);

  $scope.template_id = $sessionStorage.template_id;



  // validation
  $scope.front_Val_failed = false;
  $scope.validate = function () {
    $scope.required = true;
    if($scope.form1.$valid) {
      env.devlog('form valid');
      $scope.front_Val_failed = false;
      return true;
    } else {
      env.devlog("form not valid");
      $scope.front_Val_failed = true;
      return false;
    }

  }


  $scope.toggle_in_progress = function() {
    env.devlog($scope.new.in_progress) 
  }




  $scope.showLoader = function() {
    $scope.loading = 'true';
  }

  angular.element('#homeButton').click(function(){
    $scope.resume = [];

    delete $sessionStorage.work_id;
    delete $sessionStorage.resume_id;
    delete $sessionStorage.education_id;
  });

  $scope.resume_id = $sessionStorage.resume_id;
  $scope.formVisible = true;

  $scope.schools=[];
  $sessionStorage.work_id = '3';
  bindNextToCreate();
  $scope.message = 'work controller new';
  $scope.goback = function() {
    $scope.showLoader();
    $location.path("step2");
    alert('goin back');

  }

  $scope.seeSession = function() {
  }

  $scope.months = [
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
  $scope.years = [];
  (function(){
    var maxExperience = 50;
    var yearRangeEnd = 2018;
    var yearRangeStart = yearRangeEnd - maxExperience;
    for(var i = yearRangeStart; i < yearRangeEnd; i++) {
      $scope.years.push({
        'id': i,
        'name': i
      });
    }
  })();

  // setting defult start year and month
  $scope.start_year = $scope.years[0];
  $scope.start_month = $scope.months[0];

  //initialisation
  (function() {
    if($sessionStorage.work_id){
      bindNextToNext();
      // loadData();
      cvData.updateScope($scope);
    } else {
      bindNextToCreate()
    }


  })();


  // functions for next button behavior
  function bindNextToNext(){
    $scope.next = function() {

      // gotoStep3();
    }
  }
  function bindNextToCreate(){
    $scope.next = function() {
      createWorkEntry();
      gotoStep3();
    }
  }

  function gotostep3() {
  }


  function createWorkEntry() {
    var url = config._api_url + 'package/test';
    var data = {
      'company_name': $scope.company_name,
      'position': $scope.position,
      'location': $scope.location,
      'start_year': '' + $scope.start_year.id,
      'start_month': $scope.start_month.id,
      'resume_id':  '' + $sessionStorage.resume_id
    };

    $http({
      method: 'POST',
      data: data,
      url: config._api_url + 'step/work'
    }).then(function successCallback(response) {
        //scsses
        if(response.data.status_code == '0')
        {
          alert(response.data.id);
          $sessionStorage.resume_id = response.data.id;
          $sessionStorage.resume_id = response.data.work_id;
          $location.path("step2");
            // $location.path("/thing/"+thing.id).replace().reload(false)
          } 
          else 
          {

          }
        }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.

        });
  }

  function loadData() {

    var data = {
      'resume_id':  '' + $sessionStorage.resume_id
    };

    $http({
      method: 'GET',
      data: data,
      url: config._api_url + 'get/education?resume_id=' + $sessionStorage.resume_id
    }).then(function successCallback(response) {
      var size = response.data.result.length;
      $scope.lastJob = size-1;
      var res = response.data.result[size-1];
      


      var all = response.data.result;


      if(res) {
        function match(category) {
          return function(x){
            return x.id == category;
          }
        }
        $scope.start_year = $scope.years.filter(match(res.start_year))[0];
        $scope.start_month = $scope.months.filter(match(res.start_month))[0];
        $scope.end_year = $scope.years.filter(match(res.end_year))[0];
        $scope.end_month = $scope.months.filter(match(res.end_month))[0];


        for(var i = 0; i < size; i++) {

          $scope.schools.push({
            'index' : i,
            'closed': true,
            'school_name' : all[i].school_name,
            'location' : all[i].location,
            'degree' : all[i].degree,
            'field_of_study' : all[i].field_of_study,
            'grade' : all[i].grade,
            'start_year' : $scope.years.filter(match(all[i].start_year))[0],
            'start_month' : $scope.months.filter(match(all[i].start_month))[0],
            'graduation_year' : $scope.years.filter(match(all[i].graduation_year))[0],
            'graduation_month' : $scope.months.filter(match(all[i].graduation_month))[0],
            'in_progress' : all[i].in_progress,
            'education_id': all[i].education_id
          });
        }
      } else {
        // $scope.loadingError = true;
        if($sessionStorage.education_id) {
          $scope.loadingError = true;
        }
      }
    }, function errorCallback(response) {
      // called asynchronously if an error occurs
      // or server returns response with an error status.
      $scope.loadingError = true;
    });
}


$scope.toggle = function(x) {

  var thisValue = !$scope.schools[x].closed;
  $scope.formVisible = thisValue;
  angular.forEach($scope.schools, function(key, value) {
    $scope.schools[value].closed = true;
  })
  $scope.schools[x].closed = thisValue;
}



$scope.updateSchool = function(school, index) {
    // alert(job.company_name);

    // return;
    // var end_year = ('end_year' in job.new) ? job.end_year.id : null;
    // var end_month = ('end_month' in job.new) ? job.end_month.id : null;
    // return;
    var data = {

      'school_name' : school.school_name,
      'location' : school.location,
      'degree' : school.degree,
      'field_of_study' : school.field_of_study,
      'grade' : school.grade,
      'start_year' : school.start_year.id,
      'start_month' : school.start_month.id,
      'in_progress' : school.in_progress,
      'education_id': school.education_id

    };

    



    if(school.graduation_year != null && school.graduation_month != null && school.in_progress != 1) {

      data['graduation_year'] = school.graduation_year.id;
      data['graduation_month'] = school.graduation_month.id;
    }
    
    $http({
      method: 'POST',
      data: data,
      url: config._api_url + 'step/edit/education'
    }).then(function successCallback(response) {
        //scsses
        if(response.data.status_code == '0')
        {

          // commented 30-9-2016
          // $sessionStorage.resume_id = response.data.id;

          // close panel
          angular.forEach($scope.schools, function(key, value) {
            $scope.schools[value].closed = true;
          })
          $scope.formVisible = true;
        } 
        else 
        {

        }
      }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.

        });

  }
  function getYearMonth(category) {
    return function(x){
      return x.id == category;
    }
  }

  $scope.new = {};
  $scope.new = {
    'company_name' : '',
    'position' : '',
    'location' : '',
    'position' : '',
    'description' : '',


  }

      // company_name = 'new company_name';
      // $scope.new.position = 'new position';
      // $scope.new.location = 'new location';
      // $scope.new.start_year = $scope.years.filter(match(res.start_year))[0];
      // $scope.new.start_month = $scope.months.filter(match(res.start_month))[0];
      // $scope.new.end_year = $scope.years.filter(match(res.end_year))[0];
      // $scope.new.end_month = $scope.months.filter(match(res.end_month))[0];


      $scope.addEducation = function(){

         if($scope.validate()) {
          $scope.showLoader();

          if(!($scope.new.start_year && $scope.new.start_month)){
            alert('please select start date and year');
            $scope.loading = false;
            return;
          } 
        // var start_year = $scope.new.end_year.id ? '$scope.new.end_year.id,' : '';
        var graduation_year = ('graduation_year' in $scope.new) ? $scope.new.graduation_year.id : null;
        var graduation_month = ('graduation_month' in $scope.new) ? $scope.new.graduation_month.id : null;




        var data = {

          'school_name' : $scope.new.school_name,
          'location' : $scope.new.location,
          'degree' : $scope.new.degree,
          'field_of_study' : $scope.new.field_of_study,
          'grade' : $scope.new.grade,
          'start_year' : $scope.new.start_year.id,
          'start_month' : $scope.new.start_month.id,
          'in_progress' : $scope.new.in_progress,
          'education_id': $scope.new.education_id,
          'resume_id': $scope.resume_id

        };

        if(graduation_year && graduation_month && $scope.new.in_progress != 1){
          data['graduation_year'] = graduation_year;
          data['graduation_month'] = graduation_month;

        }

        $http({
          method: 'POST',
          data: data,
          url: config._api_url + 'step/education'
        }).then(function successCallback(response) {
              // this callback will be called asynchronously
              // when the response is available
              // $scope.schools = [];
              // loadData();
              cvData.updateScope($scope);
              $scope.new = [];
            }, function errorCallback(response) {
              // called asynchronously if an error occurs
              // or server returns response with an error status.


            });

      }
    }



    $scope.deleteSchool = function(id) {


      $http({
        method: 'GET',
        url: config._api_url + 'step/delete/education?education_id=' + id
      }).then(function successCallback(response) {
              // this callback will be called asynchronously
              // when the response is available
              // $scope.schools = [];
              // loadData();
              cvData.updateScope($scope);
            }, function errorCallback(response) {
              // called asynchronously if an error occurs
              // or server returns response with an error status.
            });
    }


    $scope.nextStep = function() {
      $scope.showLoader();
      if($scope.new.school_name) {
        $scope.addEducation();
      }
      $location.path("step5");

    }

    $scope.goback = function() {
      $scope.showLoader();
      if($scope.new.school_name) {
        $scope.addEducation();
      }
      $location.path("step2");
    }

  // getting all data
  cvData.updateScope($scope);
});










app.controller('ResumeController', [
  '$scope',
  '$localStorage',
  '$sessionStorage',
  '$http',
  'config',
  '$location',
  'cvData',
  'lang',
  'env'

  ,function($scope, $localStorage, $sessionStorage, $http, config, $location, cvData , lang, env) {
    env.type ='prod';


    $scope.front_Val_failed = false;
    $scope.validate = function () {
      $scope.required = true;
      if($scope.form1.$valid) {
        env.devlog('form valid');
        $scope.front_Val_failed = false;
        return true;
      } else {
        env.devlog("form not valid");
        $scope.front_Val_failed = true;
        return false;
      }

    }
    if(env.ifDev()){

     console.log('this is resume controller')
    }
  $scope.resumeCtrl = true;

  $scope.user_id = $sessionStorage.user_id;
  $scope.showWarning = false;
  $scope.template_id = $sessionStorage.template_id;
  // var lang = {};
  // lang.email_error = "Please enter the require fields";
  

  $scope.showLoader = function() {
    $scope.loading = 'true';
  }
  angular.element('#homeButton').click(function(){
    $scope.resume = [];

    delete $sessionStorage.work_id;
    delete $sessionStorage.resume_id;
    delete $sessionStorage.education_id;
  });

  var init = function() {

    bindNextToSubmit();
    // check the session to see if a cv is already in process
    if ($sessionStorage.resume_id) {

      $http({
        method: 'GET',
        url: config._api_url + 'get/personal?resume_id=' + $sessionStorage.resume_id
      }).then(function successCallback(response) {
        //scsses
        if (response.data.status_code == '0') {
          $scope.showWarning = false;
          $scope.resume.first_name = response.data.result.first_name;
          $scope.resume.last_name = response.data.result.last_name;
          $scope.resume.email_address = response.data.result.email_address;
          $scope.resume.phone_no = response.data.result.phone_no;
          $scope.resume.address = response.data.result.address;
          $scope.resume.city = response.data.result.city;
          $scope.resume.template_id = response.data.result.template_id;
          $scope.resume.profile_description = response.data.result.profile_description;
          $scope.resume.state = response.data.result.state;
          $scope.resume.zip_code = response.data.result.zip_code;
          bindNextToNext()


        }else if(response.data.status_code == '1'){
          $scope.showWarning = true;
          $scope.loading = false;
        }
        else {
          bindNextToSubmit()



        }
      }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.

        bindNextToSubmit()
        $scope.loadingError = true;
      });
} else {
}

}

init();


$scope.resume = [];

  // update the profile
  $scope.submitProfile = function() {
    $scope.showLoader();
    updateDescription();
    $location.path("step3");

  }



  function updateDescription() {
    var data = {
      'resume_id': $sessionStorage.resume_id,
      'profile_description': $scope.resume.profile_description

    };

    $http({
      method: 'POST',
      data: data,
      url: config._api_url + 'step/profile'
    }).then(function successCallback(response) {
      //scsses
      if (response.data.status_code == '0') {
        $scope.showWarning = false;
        $sessionStorage.resume_id = response.data.id;

      } else {

      }
    }, function errorCallback(response) {
      // called asynchronously if an error occurs
      // or server returns response with an error status.

    });
  }
  $scope.goback = function() {
    $scope.showLoader();
    updateDescription();
    $location.path("step1");
  }

  $scope.clearSession = function() {
    $sessionStorage.resume_id = "";
  }

  // binding the sbumit function to different behaviour depending on the status
  function bindNextToSubmit() {
    // submit data and create the resume
    $scope.submit = function() {
      $scope.validate();
      if($scope.validate()){
                $scope.showLoader();
      
      var url = config._api_url + 'package/test';
      var data = {
        'first_name': $scope.resume.first_name,
        'last_name': $scope.resume.last_name,
        'email_address': $scope.resume.email_address,
        'phone_no': $scope.resume.phone_no,
        'address': $scope.resume.address,
        'city': $scope.resume.city,
        'state': $scope.resume.state,
        'zip_code': $scope.resume.zip_code,
        'user_id': $scope.user_id,
        'template_id': $scope.template_id + 0
      };



      $http({
        method: 'POST',
        data: data,
        url: config._api_url + 'step/personal'
      }).then(function successCallback(response) {
        //scsseses
        if (response.data.status_code == '0') {
          $scope.showWarning = false;
          $sessionStorage.resume_id = response.data.id;
          $location.path("step2");
          // $location.path("/thing/"+thing.id).replace().reload(false)
        } else if(response.data.status_code == '1'){

          $scope.showWarning = true;
          $scope.error_email = 'Sorry! This email is already related to an account. Please login to continue'
          $scope.loading = false;
        } else if(response.data.status_code == '2'){

          $scope.showWarning = true;
          $scope.error_email = lang.email_error;
          $scope.loading = false;
        }
     }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.

      });

      var log = [];
    }
      }

  }

  function bindNextToNext() {
    $scope.submit = function() {
      $scope.validate();
     
      // update personal information
      if($scope.validate()) {
         $scope.showLoader();

                var data = {
        'resume_id': '' + $sessionStorage.resume_id,
        'first_name': $scope.resume.first_name,
        'last_name': $scope.resume.last_name,
        'email_address': $scope.resume.email_address,
        'phone_no': $scope.resume.phone_no,
        'address': $scope.resume.address,
        'city': $scope.resume.city,
        'state': $scope.resume.state,
        'zip_code': $scope.resume.zip_code,
        'user_id': $scope.user_id,
        'template_id': $scope.template_id + 0
      };


      $http({
        method: 'POST',
        data: data,
        url: config._api_url + 'step/edit/personal'
      }).then(function successCallback(response) {
        //scsses
        if (response.data.status_code == '0') {


          $scope.showWarning = false;
          $location.path("step2");

        } else if(response.data.status_code == '1'){

          $scope.showWarning = true;
          $scope.error_email = 'Sorry! This email is already related to an account. Please login to continue'
          $scope.loading = false;
        } else if(response.data.status_code == '2'){

          $scope.showWarning = true;
          // env.ifDev(){
      
          // }
          $scope.error_email = lang.email_error;
          $scope.loading = false;
        }
      }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.

      });






    }



      }


  }

  // getting all data
 cvData.updateScope($scope);


}]);


app.controller('saveController', function($scope, $localStorage, $sessionStorage, $http, config, $location, cvData){
    

  $scope.checkMail = false;

  $scope.save = function() {
    if($sessionStorage.user_id) {

      var promise = $http.get(config._api_url + 'user/isverified?user_id=' + $sessionStorage.user_id);
    promise.then(
      function(res){
        console.log(res.data.data.verified);
        if(res.data.data.verified != 1) {

          $scope.checkMail = true;
           updateResumeName(0);
        } else {
          if($scope.resume.resume_name)
          {
              updateResumeName(1);
          } 
        }
      }
      )
      
    } else {
      
      $scope.checkMail = true;
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
            $sessionStorage.resume_id = response.data.id;
           
            $scope.loading = false;
            if(redirect != 0) {

            $location.path("all");
            }
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



    // getting all data
 cvData.updateScope($scope);
});







app.controller('skillController', function(env, $scope, $localStorage, $sessionStorage, $http, config, $location, cvData){


  env.type = 'prod';
  $scope.showLoader = function() {
    $scope.loading = 'true';
  }

  $scope.hideLoader = function() {
    $scope.loading = false;
  }

$scope.template_id = $sessionStorage.template_id;
  angular.element('#homeButton').click(function(){
    $scope.resume = [];
    $scope.skillCtrl = true;

    delete $sessionStorage.resume_id;
  });

  
  $scope.skills = [];

  $scope.one ='addd';
  $scope.resume_id = $sessionStorage.resume_id;


  $scope.testIt = function() {
  }


  // $scope.skills = [];

  // init
  // pre load the list
  // loadData();


  // load all the available skills from the database
  function loadData() {
    var data = {
      'resume_id':  '' + $sessionStorage.resume_id
    };
    $http({
      method: 'GET',
      data: data,
      url: config._api_url + 'get/skills?resume_id=' + $sessionStorage.resume_id
    }).then(function successCallback(response) {
          // this callback will be called asynchronously
          // when the response is available
          if(response.data.result){
           
           var res = response.data.result.skills;
           $scope.skills = res.split(',');
         } else {
          // $scope.loadingError = true;
          
         }
         
       }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
          $scope.loadingError = true;
        });
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
          // called asynchronously if an error occurs
          // or server returns response with an error status.
          loadDefinedSkills();

        });
    // reduceSkills(); 
  }

  loadDefinedSkills();

  


      // can be used to perform a filtered query for skills
      function updateList() {
       
        if($scope.searchKey) {
          $http({
            method: 'GET',
            url: config._api_url + 'userskill?skill=' + $scope.searchKey
          }).then(function successCallback(response) {
                // this callback will be called asynchronously
                // when the response is available
                var res = response.data.data;
                $scope.setSkills = res;
                // reduceSkills();

              }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
              });
        }
      }


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
        env.devlog($scope);
        // return;
        // env.devlog($scope.skills);
        // return;
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

        if($scope.shouldCreate) {
          createNewEntry();
          $scope.shouldCreate = false;
        } else {
        updateDB();

        }
        $scope.searchKey = "";

      }


      // Triggered when closing a tag from selected skills 
      $scope.removeSkill = function(item) {
        $scope.skills = $scope.skills.filter(function(x){
          return x != item;
        });
        updateDB();
      }

      // update database
      function updateDB() {
        $scope.showLoader();
       var data = {
        'resume_id':  '' + $sessionStorage.resume_id,
        'skills' : $scope.skills.toString()
      };
      $http({
        method: 'POST',
        data: data,
        url: config._api_url + 'step/edit/skill'
      }).then(function successCallback(response) {
                // this callback will be called asynchronously
                // when the response is available
                // createNewEntry()
                $scope.loading = false;
              }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                // createNewEntry();
                                $scope.loading = false;

              });
    }

    function createNewEntry_old() {
     var data = {
      'resume_id':  '' + $sessionStorage.resume_id,
      'skills' : $scope.skills.toString()
    };
    $http({
      method: 'POST',
      data: data,
      url: config._api_url + 'step/skill'
    }).then(function successCallback(response) {
                // this callback will be called asynchronously
                // when the response is available
                $scope.loading = 'false';
              }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                $scope.loading = 'false';

              });

  }

  function createNewEntry() {
    $scope.showLoader();
   var data = {
    'resume_id':  '' + $sessionStorage.resume_id,
    'skills' : $scope.skills.toString()
  };

  var promise = $http.post(config._api_url + 'step/skill', data);
  promise.then(
    function(data){
$scope.loading = 'false';
    }
    );
  $http({
    method: 'POST',
    data: data,
    url: config._api_url + 'step/skill'
  }).then(function successCallback(response) {
                // this callback will be called asynchronously
                // when the response is available
                $scope.loading = 'false';
              }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                $scope.loading = 'false';

              });

}

  $scope.nextStep = function() {
   $location.path("step6");
 }



  // getting all data
  env.devlog('scope skills');
  env.devlog($scope.skills);
  cvData.updateScope($scope);
  env.devlog('scope skills');
  env.devlog($scope.skills.push());
});





app.controller('templateController', function($scope, $localStorage, $sessionStorage, $http, config, $location,cvData, env) {

	if(env.ifDev()){
	console.log('template controller loaded');

	}
	$scope.start = function(template_id) {
		$sessionStorage.template_id = template_id;
		$location.path("/");
	}	
});



app.controller('WorkController', function(env, $scope, $localStorage, $sessionStorage, $http, config, $location, cvData){
 
    env.type ='dev';
     $scope.disable_end_date = false;


    // validation

    $scope.front_Val_failed = false;
    $scope.validate = function () {
      $scope.required = true;
      if($scope.form1.$valid) {
        env.devlog('form valid');
        $scope.front_Val_failed = false;
        return true;
      } else {
        env.devlog("form not valid");
        $scope.front_Val_failed = true;
        return false;
      }

    }



    // handle end year and still working
    $scope.new_is_present = 0;
    $scope.toggle_end_date = function() {
       // $scope.reset_end_dates();

      // env.devlog('disabled')
      env.devlog($scope.new.is_present)
      if($scope.new.is_present == 1) {

        $scope.disable_end_date = true;
        
      } else {

        $scope.disable_end_date = false;
      }
    }


    $scope.reset_end_dates = function() {
      $scope.reset_month = '';
        $scope.reset_date = '';
    }


    // handle validation for existing items

    $scope.toggle_end_date_old_item = function(index){
      env.devlog(index);

    }




  $scope.loadingError = false;
  $scope.showLoader = function() {
    $scope.loading = 'true';
  }

   $scope.hideLoader = function() {
    $scope.loading = false;
  }
$scope.loading = false;
$scope.template_id = $sessionStorage.template_id;
 // delete $sessionStorage.work_id;
 angular.element('#homeButton').click(function(){
  $scope.resume = [];


  delete $sessionStorage.work_id;
  delete $sessionStorage.resume_id;
  delete $sessionStorage.education_id;
});

 $scope.resume_id = $sessionStorage.resume_id;
 $scope.jobs=[];

 $scope.formVisible = true;



 bindNextToCreate();
 $scope.message = 'work controller new';
 $scope.goback = function() {
  $scope.showLoader();
  $location.path("step2");
  alert('goin back');

}

$scope.seeSession = function() {
}

$scope.months = [
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
  $scope.years = [];
  (function(){
    var maxExperience = 30;
    var yearRangeEnd = 2017;
    var yearRangeStart = yearRangeEnd - maxExperience;
    for(var i = yearRangeStart; i < yearRangeEnd; i++) {
      $scope.years.push({
        'id': i,
        'name': i
      });
    }
  })();

  // setting defult start year and month
  $scope.start_year = $scope.years[0];
  $scope.start_month = $scope.months[0];

  //initialisation
  (function() {
    if($sessionStorage.resume_id){
      bindNextToNext();
      // loadData();
      cvData.updateScope($scope);
    } else {
      bindNextToCreate()
    }


  })();


  // functions for next button behavior
  function bindNextToNext(){
    $scope.next = function() {
      updateWork();
      // gotoStep3();
    }
  }
  function bindNextToCreate(){
    $scope.next = function() {
      createWorkEntry();
      gotoStep3();
    }
  }

  function gotostep3() {
  }


  function createWorkEntry() {
    var url = config._api_url + 'package/test';
    var data = {
      'company_name': $scope.company_name,
      'position': $scope.position,
      'location': $scope.location,
      'start_year': '' + $scope.start_year.id,
      'start_month': $scope.start_month.id,
      'resume_id':  '' + $sessionStorage.resume_id
    };

    $http({
      method: 'POST',
      data: data,
      url: config._api_url + 'step/work'
    }).then(function successCallback(response) {
        //scsses
        if(response.data.status_code == '0')
        {
          alert(response.data.id);
          $sessionStorage.resume_id = response.data.id;
          $sessionStorage.resume_id = response.data.work_id;
          $location.path("step2");
            // $location.path("/thing/"+thing.id).replace().reload(false)
          } 
          else 
          {

          }
        }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.

        });
  }

  function loadData() {

    var data = {
      'resume_id':  '' + $scope.resume_id
    };

    $http({
      method: 'GET',
      data: data,
      url: config._api_url + 'get/work?resume_id=' + $scope.resume_id
    }).then(function successCallback(response) {

      var size = response.data.result.length;
      $scope.lastJob = size-1;
      var res = response.data.result[size-1];
      
      if(res) {
        var all = response.data.result;
        $scope.company_name = res.company_name;
        $scope.position = res.position;
        $scope.location = res.location;
        $scope.description = res.description;

        function match(category) {
          return function(x){
            return x.id == category;
          }
        }
        $scope.start_year = $scope.years.filter(match(res.start_year))[0];
        $scope.start_month = $scope.months.filter(match(res.start_month))[0];
        $scope.end_year = $scope.years.filter(match(res.end_year))[0];
        $scope.end_month = $scope.months.filter(match(res.end_month))[0];


        for(var i = 0; i < size; i++) {

          $scope.jobs.push({
            'index' : i,
            'closed': true,
            'company_name' : all[i].company_name,
            'position' : all[i].position,
            'location' : all[i].location,
            'position' : all[i].position,
            'description' : all[i].description,
            'start_year' : $scope.years.filter(match(all[i].start_year))[0],
            'start_month' : $scope.months.filter(match(all[i].start_month))[0],
            'end_year' : $scope.years.filter(match(all[i].end_year))[0],
            'end_month' : $scope.months.filter(match(all[i].end_month))[0],
            'is_present' : all[i].is_present,
            'work_id': all[i].work_id
          });


        }
      } else {
        if($scope.work_id) {

          // alert($sessionStorage.work_id)
          $scope.loadingError = true;
        }
        
      }

      
    }, function errorCallback(response) {
      // called asynchronously if an error occurs
      // or server returns response with an error status
      // if($sessionStorage.work_id) {
      // alert($sessionStorage.work_id + "two")
      $scope.loadingError = true;
        // }
      });
}

function updateWork() {

}

$scope.toggle = function(x) {

  var thisValue = !$scope.jobs[x].closed;
  $scope.formVisible = thisValue;
  angular.forEach($scope.jobs, function(key, value) {
    $scope.jobs[value].closed = true;
  })
  $scope.jobs[x].closed = thisValue;
}





$scope.updateJob = function(job) {

    // alert(job.company_name);

    // return;
    // var end_year = ('end_year' in job.new) ? job.end_year.id : null;
    // var end_month = ('end_month' in job.new) ? job.end_month.id : null;
    // return;
    var data = {

      'company_name' : job.company_name,
      'position' : job.position,
      'location' : job.location,
      'position' : job.position,
      'description' : job.description,
      'start_year' : job.start_year.id,
      'start_month' : job.start_month.id,
      'is_present' : job.is_present,
      'work_id': job.work_id

    };


    if(job.end_year != null && job.end_month != null && job.is_present != 1) {

      data['end_year'] = job.end_year.id;
      data['end_month'] = job.end_month.id;
    }
    
    $http({
      method: 'POST',
      data: data,
      url: config._api_url + 'step/edit/work'
    }).then(function successCallback(response) {
        //scsses
        if(response.data.status_code == '0')
        {

          $sessionStorage.resume_id = response.data.id;


          // close on update
          angular.forEach($scope.jobs, function(key, value) {
            $scope.jobs[value].closed = true;
          })
          $scope.formVisible = true;

        } 
        else 
        {

        }
         cvData.updateScope($scope);  
      }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
   cvData.updateScope($scope);
        });

  }
  function getYearMonth(category) {
    return function(x){
      return x.id == category;
    }
  }

  $scope.new = {};
  $scope.new = {
    'company_name' : '',
    'position' : '',
    'location' : '',
    'position' : '',
    'description' : '',


  }

      // company_name = 'new company_name';
      // $scope.new.position = 'new position';
      // $scope.new.location = 'new location';
      // $scope.new.start_year = $scope.years.filter(match(res.start_year))[0];
      // $scope.new.start_month = $scope.months.filter(match(res.start_month))[0];
      // $scope.new.end_year = $scope.years.filter(match(res.end_year))[0];
      // $scope.new.end_month = $scope.months.filter(match(res.end_month))[0];


      $scope.addJob = function(){



        if($scope.validate()) {


                    $scope.showLoader();

        if(!($scope.new.start_year && $scope.new.start_month)){
          alert('please select start date and year');
          $scope.loading = false;
          return;
        } 
        // var start_year = $scope.new.end_year.id ? '$scope.new.end_year.id,' : '';
        var end_year = ('end_year' in $scope.new) ? $scope.new.end_year.id : null;
        var end_month = ('end_month' in $scope.new) ? $scope.new.end_month.id : null;


        var data = {

          'company_name' : $scope.new.company_name,
          'position' : $scope.new.position,
          'location' : $scope.new.location,
          'position' : $scope.new.position,
          'description' : $scope.new.description,
          'start_year' : $scope.new.start_year.id,
          'start_month' : $scope.new.start_month.id,
          'is_present' : $scope.new.is_present,
          'resume_id' : $scope.resume_id

        };

        if((end_year && end_month) && $scope.new.is_present != 1){
          data['end_year'] = end_year;
          data['end_month'] = end_month;

        }

        $http({
          method: 'POST',
          data: data,
          url: config._api_url + 'step/work'
        }).then(function successCallback(response) {
              // this callback will be called asynchronously
              // when the response is available
              // $scope.jobs = [];
              // loadData();
              $scope.new = [];
              $scope.hideLoader();
              
              // #pending1 not working when an existing item is amended and new job added
              cvData.updateScope($scope);
            
              env.devlog('job added');

              // $scope.reset_end_dates();
            }, function errorCallback(response) {
              // called asynchronously if an error occurs
              // or server returns response with an error status.
              $scope.hideLoader();

              cvData.updateScope($scope);
            });
         
         $scope.disable_end_date = false;
        }


      }



      $scope.deleteJob = function(id) {


        $http({
          method: 'GET',
          url: config._api_url + 'step/delete/work?work_id=' + id
        }).then(function successCallback(response) {
              // this callback will be called asynchronously
              // when the response is available
              // $scope.jobs = [];
              // loadData();
              cvData.updateScope($scope);
            }, function errorCallback(response) {
              // called asynchronously if an error occurs
              // or server returns response with an error status.
            });
      }

      
      $scope.nextStep = function() {




        $scope.showLoader();
        if($scope.new.company_name) {
          $scope.addJob();
        }
        $location.path("step4");



      }

      $scope.goback = function() {
        $scope.showLoader();
       if($scope.new.company_name) {
        $scope.addJob();
      }
      $location.path("step2");
    }



  // getting all data
  cvData.updateScope($scope);


});









