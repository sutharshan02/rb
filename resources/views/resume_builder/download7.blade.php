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

<link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet"> 

  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
  <style>
  
  .tagBlue, .font-mt{
    
    font-family: 'Hind', sans-serif;
  }
  .tagDescribe, .font-rw{
    
    font-family: 'Hind', sans-serif;
  }

  .light {
    font-weight: 300;
  }

  .medium {
    font-weight: 500;
  }

  .semi-bold {
    font-weight: 600;
  }

  .bold {
    font-weight: 700;
  }

  </style>
</head>
<body>

  <div class="container black">
    <div class="certificate">

    <!-- <div class="topBlue"></div> -->
                <div class="bottomBlue"></div>
          <!--Main profile detail-->
          <div class="tagInBox">
            <div class="tagBlue">
            <strong>&nbsp;&nbsp;</strong>
            </div>


            <div class="tagDescribe row">

              <div class="text-justify">


                         <!--Profile header detail-->
                          <div class="name caps font-mt bold">
                            <span class="black black-blue">{{$data['personal']['first_name']}} </span>
                            <span class="black black-blue">{{$data['personal']['last_name']}}</span>
                          </div>
                

                           <div class="contact address font-rw">
                            <span  class="li black font-mt li-first fw-medium">
                                  {{$data['personal']['address']}},
                                                        {{$data['personal']['city']}},
                                                        {{$data['personal']['state']}} {{$data['personal']['zip_code']}} 
                            </span> 
                      
                          </div><!--End profile header detail-->

                         <div class="contact font-rw">
                          <span  class="li black font-mt li-first">Cell : </span> <span class="fw-medium"> {{$data['personal']['phone_no']}}</span> 
                          <span class="li black font-mt"> Email : </span> <span class="fw-medium">{{$data['personal']['email_address']}}</span>
                        </div><!--End profile header detail-->



                  </div>
                </div><!--End main profile detail-->


            </div>
     
    <hr>
    <!--Main profile detail-->
    <div class="tagInBox">
      <div class="tagBlue blue"><strong class="blue">PROFILE</strong></div>
      <div class="tagDescribe row">
        <div class="text-justify"><b class="black"></b> {!! $data['personal']['profile_description'] !!}</div>

      </div>
    </div><!--End main profile detail-->


    @if(sizeof($data['education']))
    <!--EDUCATION section-->
    <hr>
    <?php $i = 0; ?>

    <div class="tagInBox ">
      <div class="tagBlue blue">
       @if($i == 0)
       <strong class="blue">EDUCATION</strong>
       @else
       &nbsp;
       @endif
       <?php $i++ ?>

     </div>


     <div class="tagDescribe row">

    <div class="row">
      
  <?php $i = 0; ?>

    @foreach ($data['education']  as $education)

    <?php $i++; ?>
      <div class="col-xs-6">

        <div class="row">
          
            <div class="black font-mt col-xs-12 bold" >
              {{$education['school_name']}}
            </div>
            <div class="col-xs-12">{{$education['location']}}</div>
           <div class="col-xs-12 blue">

               {{$education['degree']}} 

            </div>
            <div class="col-xs-12">
              

              @if($education['gpa'])
              GPA: {{$education['gpa']}} 
              @endif
            </div>
            <div class="col-xs-12" style="padding-top: 3px;">{{$education['field_of_study']}}</div>
            <div class="col-xs-12">
              {{$education['start_year']}} -

                   @if($education['in_progress'])
                   Present
                   @elseif ($education['graduation_date'])
                   {{ $education['graduation_year'] }}
                   @endif
            </div>
       
            <div class="html education-description col-xs-12">{!!$education['description']!!}</div>

        </div>

      </div>

      @if($i % 2 == 0 )

        </div>
         <div style="margin-top: 20px;"class="row">

      @endif


  @endforeach
</div>
    </div>
    
  </div><!--END EDUCATION section-->
  <br/>
  @endif

  @if($data['skills']['skills'])
  <?php 

  $skills = $data['skills']['skills'];
  $skillArray = explode(",", $skills);
                      // var_dump($skillArray);
  ?>
  <!--SKILLS section-->
  <hr>
  <div class="tagInBox">
    <div class="tagBlue blue">
      <strong class="blue">SKILLS</strong>

    </div>
    <div class="tagDescribe row">
      <div class="row">
             @foreach( $skillArray as $skill)
            <div class="li col-sm-6">
              
                
                {{ $skill }}


              </div>
              @endforeach
      </div>
 

    </div>
  </div><!--End SKILLS section-->
  @endif


  @if(sizeof($data['work']))
  <!--EDUCATION section-->
  <hr>
  <div class="tagInBox">
    <div class="tagBlue blue">
      <strong class="blue">Experience</strong>

    </div>
    <div class="tagDescribe was-row">

      @foreach ($data['work']  as $work) 
      <div class="para3 row">
        <div class="col-sm-7"><b class="color-3a3a3a font-mt">{{$work['company_name']}}</b></div>
        <div class="col-sm-5">

         <b class="color-3a3a3a font-mt" style="font-weight: 400;"> 
         {{$work['start_year']}} - 
                      @if($work['is_present'])
                      Present
                      @elseif ($work['end_date'])
                      {{ $work['end_year'] }}
                      @endif

          </b>
        </div>
        <div class="col-sm-8"><b class="blue " style="font-weight: 400;">{{$work['position']}}</b></div>
        <div>
          
        </div>
        @if($work['description'])
        <br/>
        <div class="html color-3a3a3a  col-xs-12">{!!$work['description']!!} 
        <br/> 
        </div>
        @endif
        @if($work['responsibilities'])
        
        <div class="html col-xs-12">{!!$work['responsibilities']!!}</div>
        @endif
      </div>
      @endforeach


    </div>
  </div><!--End EDUCATION section-->
  @endif

<hr>

  <div class="tagInBox">
    <div class="tagBlue blue">
      <strong class="blue">&nbsp;</strong>

    </div>
    <div class="tagDescribe row" style="font-size: 10px;">
    
      
              
           {{$data['personal']['address']}},
           {{$data['personal']['city']}},
           {{$data['personal']['state']}} {{$data['personal']['zip_code']}}

           @if($data['personal']['phone_no'])<span class="blue">
           | </span><span class="black">Cell </span> {{$data['personal']['phone_no']}} 
           @endif

           @if($data['personal']['email_address'])<span class="blue">
           | </span><span class="black"> Email </span> {{$data['personal']['email_address']}}
           @endif
   

      </div>


    </div>
  </div><!--End SKILLS section-->




 </div>

</div>

@include('/resume_builder/includes/css')

<style>
  .tagDescribe {
    width: 580px;
  }

  .blue , .tagBlue, .black.black-blue{
    color:  #2da4a5;
  }

  .tagBlue {
    width:  160px;
  }

  .tagDescribe {
    width:  540px;
  }

  .li:before {
    content:  '•';
    display: inline-block;
    padding-right:  13px;
    color: #2da4a5;
    transform: scale(2);
    transform-origin: center 42%;

  }

  .contact .li:before, .li-address {
    padding-right: 8px;
    padding-left: 8px;
  }

  .contact .li-first:before, .li-address.li-first {
    padding-right: 8px;
    padding-left: 3px;
  }



  .color-3a3a3a {
    color: #3a3a3a;
  }

  *:not(.blue) {
    color:  #3a3a3a;
  }

  .fw-medium {
    font-weight: 600;
  }

  .bottomBlue {
    background-color: #2da4a5 ;
  }
</style>
</body>
</html>
