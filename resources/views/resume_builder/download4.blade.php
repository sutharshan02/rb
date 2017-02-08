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

    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet"> 
    <!-- <link rel="stylesheet" href="{{url('/dist')}}/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="{{url('/dist')}}/css/bootstrap-grid.css"> -->
    <!-- <link rel="stylesheet" href="{{url('/dist')}}/css/style.css"> -->
    <!-- <link rel="stylesheet" href="{{url('/dist')}}/css/res.css"> -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
</head>
<body>

    <div class="container black">
        <div class="certificate">
            <h1>{{$data['personal']['first_name']}} {{$data['personal']['last_name']}}</h1>

            <div class="brownline">{{$data['personal']['address']}}, {{$data['personal']['city']}}, {{$data['personal']['state']}} {{$data['personal']['zip_code']}}    
                <span>+</span>   
                {{$data['personal']['phone_no']}}
                <span>+</span>   
                {{$data['personal']['email_address']}}
            </div>

            <div class="inBoxTo">
                <div class="brownSubHeader">Profile</div>
                <p class="text-justify">{!! $data['personal']['profile_description'] !!} </p>
            </div>



            <?php $i = 0; ?>
            @foreach ($data['education']  as $education) 
            @if($i == 0)
            <div class="inBoxTo">
                <div class="brownSubHeader">Education</div>

                @else
                <div>
                    <div class="table">
                        @endif
                        @if($i > 0)
                       <!--  <p>&nbsp;</p> -->
                        @endif
                        <div class="was-row">
                            <div class="col-sm-8 no-l">
                                <p class="bold">
                                    {{$education['school_name']}}, {{$education['location']}}
                                
                                    
                                </p>
                            </div>
                            <div class="col-sm-4 no-r">
                                <b class="Fright">{{$education['start_year']}}-
                                   @if($education['in_progress'])
                                   Present
                                   @elseif ($education['graduation_date'])
                                   {{ $education['graduation_year'] }}
                                   @endif
                               </b>

                           </div>

                       </div>
                       <div class="was-row">
                       <div class="col-xs-12 no-l no-r">
                           {{$education['degree']}} <br/>
                           @if($education['gpa'])
                                    GPA: {{$education['gpa']}} <br />
                                    @endif
                                    {{$education['field_of_study']}}
                                    <br/>
                       </div>
                        <div class="col-xs-12 no-l no-r ">
                            <div class="html education-description">{!!$education['description']!!}</div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
                @endforeach


                @if($data['skills']['skills'])
                <?php 

                $skills = $data['skills']['skills'];
                $skillArray = explode(",", $skills);
                      // var_dump($skillArray);
                ?>
                <div class="inBoxTo">
                    <div class="brownSubHeader">Skills</div>
                    <div class="row">
                            <?php $i = 0; ?>
                            @foreach( $skillArray as $skill)
                        <div class="col-sm-4">
                            <p class="skill-item">{{ $skill }}</p> 

                            <?php $i++; ?>
                        
                        </div>
                            @endforeach

                    </div>
                </div>
                @endif
                
                @if(sizeof($data['work']))
                <div class="inBoxTo">
                    <div class="brownSubHeader">Experience</div>
                    @foreach ($data['work']  as $work) 
                    <div class="was-row table">
                        <div class="col-sm-8 no-l">
                            <p>
                                <b>{{$work['company_name']}}</b><br />
                                {{$work['position']}}
                            </p>
                            <p>
                                
                            </p>
                        </div>
                        <div class="col-sm-4 no-r">
                            <b class="Fright"> {{$work['start_year']}} - 
                                @if($work['is_present'])
                                Present
                                @elseif ($work['end_date'])
                                {{ $work['end_year'] }}
                                @endif

                            </b>
                        </div>
                    </div>

                    @if($work['description'])
         
                    <div class="html work-description">{!!$work['description']!!}</div>
                    @endif
                    @if($work['responsibilities'])
    
                    <div class="html work-description">{!!$work['responsibilities']!!}</div>
                    @endif




                    <br />
                    @endforeach
                    
                </div>
                @endif 


            </div>
        </div>

        @include('/resume_builder/includes/css')

        <style> 
                * {
                    font-family: 'Lora', serif;
                    line-height: 23px;
                }

                .brownSubHeader {
                    padding-bottom: 15px;
                }
                p {
                    margin-bottom: 0;
                }

                .education-description {
                    padding-top:  5px;
                    margin-bottom: 10px;
                }

                .work-description {
                    padding-top: 5px;
                    padding-bottom: 5px;
                }

                .skill-item {
                    padding-top: 5px;
                    padding-bottom: 5px;
                }
        </style>
    </body>
    </html>
