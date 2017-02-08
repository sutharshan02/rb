app.controller('WorkController', function(Page, env, $scope, $localStorage, $sessionStorage, $http, config, $location, cvData){
    Page.setTitle('Step 3 - Work');


    if($sessionStorage.template_id != null) {
      $scope.preview_template_id = $sessionStorage.template_id;
    } else {
      $scope.preview_template_id = 1;
    }
    env.type ='prod';
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
    $scope.loading = true;
  }

   $scope.hideLoader = function() {
    $scope.loading = false;
  }
$scope.loading = false;
$scope.template_id = $sessionStorage.template_id;
 $scope.resume_id = $sessionStorage.resume_id;
 $scope.jobs=[];

 $scope.formVisible = true;

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


    // hasStartYear = (job.start_year) ? true : false;
    // hasStartMonth = (job.start_Month) ? true : false;


    var data = {

      'company_name' : job.company_name,
      'position' : job.position,
      'location' : job.location,
      'position' : job.position,
      'description' : job.description,
      'responsibilities' : job.responsibilities,
      'is_present' : job.is_present,
      'work_id': job.work_id

    };


   // if(hasStartYear) {
   //  start_year     = ('start_year' in job) ? job.start_year.id : null;
   //    data['start_year']  = start_year;
   //    // alert('start year set: ' + hasStartYear);
   //  }

    if(job.start_year_text != null) {
      data['start_year']  = job.start_year_text.id;
        var start_year     = ('start_year_text' in job) ? job.start_year_text.id : null;
    job.end_year  = end_year;
    }

    if(job.start_month_text != null) {
      data['start_month']  = job.start_month_text.id;
        var start_month    = ('start_month_text' in job) ? job.start_month_text.id : null;
    job.end_month = end_month;
    }

    // if(hasStartMonth) {
    //    start_month    = ('start_month' in job) ? job.start_month.id : null;
    //   data['start_month']  = start_month;
    // }



    if(job.is_present != 1 && job.end_year_text != null) {

      data['end_year'] = job.end_year_text.id;
        var end_year = ('end_year_text' in job) ? job.end_year_text.id : null;
    job.start_year = start_year;
    
    }


    if(job.is_present != 1 && job.end_month_text != null) {

    
      data['end_month'] = job.end_month_text.id;
        var end_month = ('end_month_text' in job) ? job.end_month_text.id : null;
    job.start_month = start_month;
    }

        

    
    job.count_level = job.is_present==true?1000000:0;
              if(job.count_level ==0)
              {
                 job.count_level  = (end_year!=null?end_year:0)+""+(end_month!=null?end_month:"00")
              }
    console.log(data);
    
    $scope.jobs.sort(function(a, b){
                a = parseInt(a['count_level']);
                b = parseInt(b['count_level']);
                return b - a;
              });
    
    $http({
      method: 'POST',
      data: data,
      url: config._api_url + 'step/edit/work'
    }).then(function successCallback(response) {
        //scsses
        if(response.data.status_code == '0')
        {

          $sessionStorage.resume_id = response.data.id;
          $sessionStorage.cvdata = response.data.resume_data.result;

          // close on update
          angular.forEach($scope.jobs, function(key, value) {
            $scope.jobs[value].closed = true;
          })
          $scope.formVisible = true;

        } 
        else 
        {

        }
         // cvData.updateScope($scope); 
         $scope.new = []; 
      }, function errorCallback(response) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
   // cvData.updateScope($scope);
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
          
          var hasStartYear = ($scope.new.start_year) ? true : false;
          var hasStartMonth = ($scope.new.start_Month) ? true : false;
      

        if(!($scope.new.start_year && $scope.new.start_month)){
          // alert('please select start date and year');
          console.log($scope.new);
          // $scope.loading = false;
          // return;
          var start_year = null;
          var start_month = null;
        } 
        // var start_year = $scope.new.end_year.id ? '$scope.new.end_year.id,' : '';

        else {

          start_year     = ('start_year' in $scope.new) ? $scope.new.start_year.id : null;
          start_month    = ('start_month' in $scope.new) ? $scope.new.start_month.id : null;
        }

         var end_year = ('end_year' in $scope.new) ? $scope.new.end_year.id : null;
         var end_month = ('end_month' in $scope.new) ? $scope.new.end_month.id : null;


        var data = {

          'company_name' : $scope.new.company_name,
          'position' : $scope.new.position,
          'location' : $scope.new.location,
          'position' : $scope.new.position,
          'description' : $scope.new.description,
          'responsibilities' : $scope.new.responsibilities,
          'is_present' : $scope.new.is_present,
          'resume_id' : $scope.resume_id

        };

        if(start_year != null) {
          data['start_year']  = start_year;
          // alert('start year set: ' + hasStartYear);
        }

        if(start_month != null) {
          data['start_month']  = start_month;
        }

        if((end_year && end_month) && $scope.new.is_present != 1){
          data['end_year'] = end_year;
          data['end_month'] = end_month;

        }

        $http({
          method: 'POST',
          data: data,
          url: config._api_url + 'step/work'
        }).then(function successCallback(response) {

              // creating job item to update the scope
              $scope.newCopy = $scope.new;
              $scope.newCopy['start_month_text'] = $scope.newCopy.start_month;
              $scope.newCopy['start_year_text'] = $scope.newCopy.start_year;
              $scope.newCopy['end_month_text'] = $scope.newCopy.end_month;
              $scope.newCopy['end_year_text'] = $scope.newCopy.end_year;
              $scope.newCopy['work_id'] = response.data.work_id;
              $scope.newCopy['is_present'] = $scope.newCopy.is_present;
              $scope.newCopy['count_level'] = $scope.newCopy.is_present==true?1000000:0;
              if($scope.newCopy['count_level']==0)
              {
                 $scope.newCopy['count_level'] = (end_year!=null?end_year:0)+""+(end_month!=null?end_month:0)
              }
              $scope.newCopy['closed'] = true;
           
              $sessionStorage.cvdata = response.data.resume_data.result;
              // #pending1 not working when an existing item is amended and new job added
              // cvData.updateScope($scope);
              $scope.jobs.push($scope.newCopy);
              $scope.jobs.sort(function(a, b){
                a = parseInt(a['count_level']);
                b = parseInt(b['count_level']);
                return b - a;
              });
              $scope.newCopy = [];
              $scope.new = [];
              $scope.job = [];
              env.devlog('job added');
               if(!$scope.$$phase) {
              //$digest or $apply
                $scope.$apply();
              }
              $scope.hideLoader();

              // $scope.reset_end_dates();
            }, function errorCallback(response) {
              // called asynchronously if an error occurs
              // or server returns response with an error status.
              $scope.hideLoader();

              // cvData.updateScope($scope);

            });
         
         $scope.disable_end_date = false;
        }


      }



      $scope.deleteJob = function(id, index) {


        $http({
          method: 'GET',
          url: config._api_url + 'step/delete/work?work_id=' + id
        }).then(function successCallback(response) {
              // this callback will be called asynchronously
              // when the response is available
              // $scope.jobs = [];
              // loadData();
              $sessionStorage.cvdata = response.data.resume_data.result;

              $scope.jobs.splice(index, 1);
              if(!$scope.$$phase) {
              //$digest or $apply
                $scope.$apply();
              }
              //cvData.updateScope($scope);// 19-12-2016
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

  // getting all data
  cvData.updateScope($scope);





});









