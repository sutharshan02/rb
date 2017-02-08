<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

       
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
      <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" rel="stylesheet"> 
      <style>
          * {
        font-family: 'Droid Serif', serif;
        }

        .bold {
            font-weight: 700;
        }
        .logName {
            font-weight: 700;
        }

        .i {
            font-style: italic;
        }

        .rbm {
            margin-bottom: 0;
        }

        .color-99999 {
            color: #999999;
        }


        .fs-main {
            font-size:  16px !important;
        }
      </style>
    </head>
    <body>

        <div class="container black">
            <div class="certificate">
                <div class="topBlue"></div>
                <div class="bottomBlue"></div>
                <div class="blueTop">

                    <div class="">
                        <div class="col-sm-7 no-l">
                            <h1 class="caps bold">{{$data['personal']['first_name']}} {{$data['personal']['last_name']}}</h1>
                            <div class="introDoc"></div>
                        </div>
                        <div class="col-sm-5 no-r">
                            <div class="contact-detail">
                                <div>{{$data['personal']['phone_no']}}</div>
                                <div>{{$data['personal']['email_address']}}</div>
                                <div>{{$data['personal']['address']}}, {{$data['personal']['city']}} <br/> {{$data['personal']['state']}} {{$data['personal']['zip_code']}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin: 50px 0;">&nbsp;</div>
    


                <div class="certificateRow dashbottom">
                    <div class="logName">Profile</div>
                    <div class="html ContentLog text-justify">{!! $data['personal']['profile_description'] !!}</div>
                </div>

                <?php $i = 0; ?>
                @if(sizeof($data['education']))
                <div class="certificateRow dashbottom">
                    <div class="logName"><h4 class="logName" style="margin-top: 0px;">Education</h4></div>


                    <div class="ContentLog">
                      

                        <div class="">

                         @foreach ($data['education']  as $education)
                         <div  style="padding-right: 0; padding-left: 0;" class="col-sm-12">

                          @if($i > 0) 
                        <p style="padding: 20px;" >&nbsp;</p>
                        @endif
                        <?php $i++ ?>
                            <div class="">
                                <div class="col-xs-8 i" style="padding-left: 0px;">
                                    <h4 style="margin-top: 0" class="fs-main"><strong>{{$education['school_name']}}</strong>@if($education['location']),
                                        {{$education['location']}}
                                    @endif
                                    </h4>
                                    
                                </div>
                                <div class="col-xs-4 no-r">
                          
                                   <strong class="Fright i fs-main">  
                                     {{$education['start_year']}} - 
                                       @if($education['in_progress'])
                                       Present
                                       @elseif ($education['graduation_date'])
                                       {{ $education['graduation_year'] }}
                                       @endif
                                   </strong>
                                </div>
                            </div>

                                <div class="grayColor was-row">
                                    <div class="col-xs-12 no-l no-r">
                                         {{$education['degree']}}

                                    @if($education['gpa'])
                                       , GPA: {{$education['gpa']}} <br />
                                    @endif
                                    </div>
                                   <div class="col-xs-12 no-l no-r"> 
                                       
                                    {{$education['field_of_study']}}<br />
                                   </div>
                                   <div class="col-xs-12 no-l no-r">
                                    <span class="html">{!!$education['description']!!}</span>
                                    </div>                                 



                                    <br />
                                </div>
                                    <br />
                                    <br />

                            </div>
                            @endforeach
                     
                        </div>
                    </div>
                </div>
                @endif



                @if($data['skills']['skills'])
                <?php 

                $skills = $data['skills']['skills'];
                $skillArray = explode(",", $skills);
                      // var_dump($skillArray);
                ?>
                <div class="certificateRow dashbottom">
                    <div class="logName">Skills</div>
                    <div class="ContentLog">
                        <div class="row">
                              <?php $i = 0; ?>
                                    @foreach( $skillArray as $skill)
                            <div class="col-sm-4">
                                                  <p>{{ $skill }}</p> 

                            </div>
                                    <?php $i++; ?>
                         
                                    @endforeach
                            
      
                        </div>
                    </div>
                </div>
                @endif



                @if(sizeof($data['work']))
                <div class="certificateRow dashbottom">
                    <div class="logName"><h4 class="logName ">Experience</h4></div>
                    <div class="ContentLog">
                    <?php $i = 0; ?>
                      @foreach ($data['work']  as $work) 

                        

                        <div class="companyBox was-row">
                          @if($i > 0) 
                            <p  >&nbsp;</p>
                        @endif
                            <div class="col-xs-8 no-r no-l">
                          
                      <?php $i++; ?>
                                <h4 class="i rbm fs-main" style="   ">
                                <strong>{{$work['company_name']}} </strong>
             
                                    @if(!empty($work['location']))

                                            <span class="work_location"> - {{$work['location']}} </span>

                                    @endif
                                </h4>  
                            </div>
                           
                            <div class="col-xs-4 no-l no-r">
                               <b class="pull-right i fs-main">{{$work['start_year']}} - 

                              @if($work['is_present'])
                              Present
                              @elseif ($work['end_date'])
                              {{ $work['end_year'] }}
                              @endif</b>  
                            </div>
                            


                            <div class="col-xs-12 i color-99999 no-l fs-main">
                                <h4 class="bold fs-main">{{$work['position']}}</h4>
                            </div>


                            @if($work['description'])
                        
                                <div class="html col-xs-12 no-l no-r">{!!$work['description']!!} <br/><br/></div>
                            @endif
                            @if($work['responsibilities'])
                        
                                <div class="html col-xs-12 no-l no-r">{!!$work['responsibilities']!!}</div>
                            @endif
                           
                        </div>
                      @endforeach



                 
                    </div>
                </div>
                @endif








            </div>
        </div>


        @include('/resume_builder/includes/css')

    </body>
</html>
