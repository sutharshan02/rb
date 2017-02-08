app.controller('ResumeController', [
    '$scope',
    '$localStorage',
    '$sessionStorage',
    '$http',
    'config',
    '$location',
    'cvData',
    'lang',
    'env',
    'Page'

            , function ($scope, $localStorage, $sessionStorage, $http, config, $location, cvData, lang, env, Page) {


              
                console.log("template id at top: " + $scope.preview_template_id);
                $scope.currentPath = $location.path();
                if($scope.currentPath == '/step2'){
        
                Page.setTitle('Step 2 - Profile');
                }
                else {

                Page.setTitle('Step 1 - About You');
                }
       
                env.type = 'prod';

                if($sessionStorage.template_id == null) {
                    $scope.preview_template_id = 1;
                    if(!$scope.$$phase) $scope.$apply()
                } else {
                    $scope.preview_template_id = $sessionStorage.template_id;
                    if(!$scope.$$phase) $scope.$apply()
                }


                $scope.front_Val_failed = false;
                $scope.validate = function () {
                    $scope.required = true;
                    if ($scope.form1.$valid) {
                        env.devlog('form valid');
                        $scope.front_Val_failed = false;
                        return true;
                    } else {
                        env.devlog("form not valid");
                        $scope.front_Val_failed = true;
                        return false;
                    }

                }
                $scope.resumeCtrl = true;

                
                // $scope.template_id = 3;
                // var lang = {};
                // lang.email_error = "Please enter the require fields";


                $scope.showLoader = function () {
                    $scope.loading = 'true';
                }
                var init = function () {
                    if($sessionStorage.template_id==null)
                        $sessionStorage.template_id =5;
                }

                init();
                $scope.user_id = $sessionStorage.user_id;
                $scope.showWarning = false;
                
                // template selection moved to end
                $scope.template_id = $sessionStorage.template_id;

                $scope.resume = [];

                // update the profile
                $scope.submitProfile = function () {
                    $scope.validate();
                    if($scope.validate()) {
                        
                        $scope.showLoader();
                        updateDescription();
                        $location.path("step3");
                    }

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
                            $sessionStorage.cvdata = response.data.resume_data.result;
                        } else {

                        }
                    }, function errorCallback(response) {
                        // called asynchronously if an error occurs
                        // or server returns response with an error status.

                    });
                }
                $scope.goback = function () {
                    $scope.showLoader();
                    updateDescription();
                    $location.path("step1");
                    
                }


                $scope.submit = function () {
                    $scope.validate();
                    if ($scope.validate()) {
                        $scope.showLoader();

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
                            'template_id': $scope.template_id
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
                                $sessionStorage.cvdata = response.data.resume_data.result;
                                $location.path("step2");
                                Page.setTitle('Step 2 - Profile')
                                // $location.path("/thing/"+thing.id).replace().reload(false)
                            } else if (response.data.status_code == '1') {

                                $scope.showWarning = true;
                                $scope.error_email = 'Sorry! This email is already related to an account. Please login to continue'
                                $scope.loading = false;
                            } else if (response.data.status_code == '2') {

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

                // getting all data
//            if($location.path()=="/edit")
//            {
                $http({
                            method: 'GET',
                            url: config._api_url + 'get/allcvdata'
                        }).then(function successCallback(response) {
                            //scsseses
                            if (response.data.status_code == '0') {
                                $scope.showWarning = false;
                                $sessionStorage.resume_id = response.data.id;
                                $sessionStorage.template_id = response.data.result.personal.template_id;
                                $sessionStorage.cvdata = response.data.result;
                                $scope.template_id =  response.data.result.personal.template_id;
                                cvData.updateScope($scope);
                                
                            } else if (response.data.status_code == '1') {

                                $scope.loading = false;
                            } else if (response.data.status_code == '2') {
                                $scope.loading = false;
                                delete $sessionStorage.resume_id;
                                delete $sessionStorage.cvdata;
                            }
                            if($sessionStorage.template_id) {

                            $scope.preview_template_id = $sessionStorage.template_id;
                            } else {
                                // $scope.preview_template_id = 5;
                            }
                            if(!$scope.$$phase) $scope.$apply()
                        }, function errorCallback(response) {
                            // called asynchronously if an error occurs
                            // or server returns response with an error status.

                        });
//            }else{
//                cvData.updateScope($scope);
//            }


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

                console.log($scope.preview_template_id);
                 if(!$scope.$$phase) $scope.$apply()
            }]);