

app.controller('EducationController', function(Page, env,$scope, $localStorage, $sessionStorage, $http, config, $location, cvData){
  Page.setTitle('Step 4 - Education')



      $scope.preview_template_id = $sessionStorage.template_id;


  console.log('session template', $sessionStorage.template_id);
  env.type="prod";

  cvData.updateScope($scope);

  $scope.template_id = $sessionStorage.template_id;
  console.log('session template', $sessionStorage.template_id);



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


  $scope.resume_id = $sessionStorage.resume_id;
  $scope.formVisible = true;

  $scope.schools=[];

  $scope.message = 'work controller new';
  $scope.goback = function() {
    $scope.showLoader();
    $location.path("step2");
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

$scope.toggle = function(x) {

  var thisValue = !$scope.schools[x].closed;
  $scope.formVisible = thisValue;
  angular.forEach($scope.schools, function(key, value) {
    $scope.schools[value].closed = true;
  })
  $scope.schools[x].closed = thisValue;
}



$scope.updateSchool = function(school) {

    // alert(job.company_name);

    // return;
    // var end_year = ('end_year' in job.new) ? job.end_year.id : null;
    // var end_month = ('end_month' in job.new) ? job.end_month.id : null;


    // return;

      // hasStartYear = (school.start_year) ? true : false;
      // hasStartMonth = (school.start_Month) ? true : false;
      
   


    var data = {

      'school_name' : school.school_name,
      'location' : school.location,
      'degree' : school.degree,
      'field_of_study' : school.field_of_study,
      'grade' : school.grade,
      'gpa' : school.gpa,
      'description' : school.description,

      'in_progress' : school.in_progress,
      'education_id': school.education_id

    };


      // if(hasStartYear) {
      //   start_year     = ('start_year' in school) ? school.start_year.id : null;
      //     data['start_year']  = start_year;
      //     // alert('start year set: ' + hasStartYear);
      //   }

      //   if(hasStartMonth) {
      //      start_month    = ('start_month' in school) ? school.start_month.id : null;
      //     data['start_month']  = start_month;
      //   }

    if(school.start_year_text != null) {
      data['start_year']  = school.start_year_text.id;
      var start_year     = ('start_year_text' in school) ? school.start_year_text.id : null;
      school.start_year = start_year;
    }

    if(school.start_month_text != null) {
      data['start_month']  = school.start_month_text.id;
      var start_month    = ('start_month_text' in school) ? school.start_month_text.id : null;
      school.start_month = start_month;
    }
    

    // if((school.start_year_text != null && school.start_month_text == null) || (school.start_year_text == null && school.start_month_text != null))
    // {
    //   editValid = false;
    //   jQuery('#start_date').append('<p>please select both year and month</p>');
    //   alert('date failed');
    //   return false;
    // }


    if(school.in_progress != 1 && school.graduation_year_text != null) {
      console.log('graduation year set')
      data['graduation_year'] = school.graduation_year_text.id;
        var end_year = ('graduation_year_text' in school) ? school.graduation_year_text.id : null;

    school.graduation_year  = end_year;
    } 
    
    if(school.in_progress != 1 && school.graduation_month_text != null) {


      data['graduation_month'] = school.graduation_month_text.id;
        var end_month = ('graduation_month_text' in school) ? school.graduation_month_text.id : null;
        school.graduation_month = end_month;
    }
    
        

    
    school.count_level = school.in_progress==true?1000000:0;
              if(school.count_level ==0)
              {
                 school.count_level  = (end_year!=null?end_year:0)+""+(end_month!=null?end_month:"00")
              }
    console.log(data);
    
    $scope.schools.sort(function(a, b){
                a = parseInt(a['count_level']);
                b = parseInt(b['count_level']);
                return b - a;
              });
    
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
          $sessionStorage.cvdata = response.data.resume_data.result;
          // cvData.updateScope($scope);
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

         var hasStartYear = ($scope.new.start_year) ? true : false;
          var hasStartMonth = ($scope.new.start_Month) ? true : false;

          if(!($scope.new.start_year && $scope.new.start_month)){
            // alert('please select start date and year');
            // $scope.loading = false;
            // return;

              var start_year = null;
              var start_month = null;
          } 

          else {


              start_year     = ('start_year' in $scope.new) ? $scope.new.start_year.id : null;
              start_month    = ('start_month' in $scope.new) ? $scope.new.start_month.id : null;


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
          'gpa' : $scope.new.gpa,
          'description' : $scope.new.description,
          'in_progress' : $scope.new.in_progress,
          'education_id': $scope.new.education_id,
          'resume_id': $scope.resume_id

        };


           if(start_year != null) {
          data['start_year']  = start_year;
          // alert('start year set: ' + hasStartYear);
        }

        if(start_month != null) {
          data['start_month']  = start_month;
        }

        if(graduation_year && graduation_month && $scope.new.in_progress != 1){
          data['graduation_year'] = graduation_year;
          data['graduation_month'] = graduation_month;

        }

        console.log(data);

        $http({
          method: 'POST',
          data: data,
          url: config._api_url + 'step/education'
        }).then(function successCallback(response) {
              // this callback will be called asynchronously
              // when the response is available
              // $scope.schools = [];
              // loadData();

              console.log('all item');
              console.log($scope.schools)

              // creating school iem to update the scope
              $scope.newCopy = $scope.new;
              $scope.newCopy['start_month_text'] = $scope.newCopy.start_month;
              $scope.newCopy['start_year_text'] = $scope.newCopy.start_year;
              $scope.newCopy['graduation_month_text'] = $scope.newCopy.graduation_month;
              $scope.newCopy['graduation_year_text'] = $scope.newCopy.graduation_year;
              $scope.newCopy['education_id'] = response.data.education_id;
              $scope.newCopy['closed'] = true;
              $scope.newCopy['count_level'] = $scope.newCopy.in_progress==true?1000000:0;
              if($scope.newCopy['count_level']==0)
              {
                 $scope.newCopy['count_level'] = (graduation_year!=null?graduation_year:0)+""+(graduation_month!=null?graduation_month:0)
              }

              $sessionStorage.cvdata = response.data.resume_data.result;
              // cvData.updateScope($scope);

              $scope.schools.push($scope.newCopy);
              
              
            console.log(data);

            $scope.schools.sort(function(a, b){
                a = parseInt(a['count_level']);
                b = parseInt(b['count_level']);
                return b - a;
              });
              $scope.loading = false;
              $scope.new = [];
              $scope.newCopy = []
              if(!$scope.$$phase) {
              //$digest or $apply
                $scope.$apply();
              }
            }, function errorCallback(response) {
              // called asynchronously if an error occurs
              // or server returns response with an error status.


            });

      }
    }



    $scope.deleteSchool = function(id, index) {


      $http({
        method: 'GET',
        url: config._api_url + 'step/delete/education?education_id=' + id
      }).then(function successCallback(response) {
              // this callback will be called asynchronously
              // when the response is available
              // $scope.schools = [];
              // loadData();
              $sessionStorage.cvdata = response.data.resume_data.result;
              // cvData.updateScope($scope);

              $scope.schools.splice(index, 1);
              if(!$scope.$$phase) {
              //$digest or $apply
                $scope.$apply();
              }
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
      $location.path("step3");
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

  cvData.updateScope($scope);
});









