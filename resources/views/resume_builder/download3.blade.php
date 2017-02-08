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
<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet"> 

  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
  <style>
  
  .tagBlue, .font-mt{
    
    font-family: 'Montserrat', sans-serif;
  }
  .tagDescribe, .font-rw{
    
    font-family: 'Raleway', sans-serif;
  }

  .color-99a3a8 {
    color: #99a3a8;
  }

  </style>
</head>
<body>

  <div class="container black">
    <div class="certificate">

      <!--Profile header detail-->
      <div class="name caps font-mt">
        <span class="black">{{$data['personal']['first_name']}} </span>
        <span class="blue">{{$data['personal']['last_name']}}</span>
      </div>
      <div class="address font-rw color-99a3a8">
       {{$data['personal']['address']}}
       <span class="blue">-</span>
       {{$data['personal']['city']}}
       <span class="blue">-</span>
       {{$data['personal']['state']}} {{$data['personal']['zip_code']}}   

     </div>
     <div class="contact font-rw color-99a3a8">
      <span class=" font-mt color-99a3a8"><strong class="black">Cell</strong> </span>  {{$data['personal']['phone_no']}} &nbsp; | &nbsp;
      <span class=" font-mt color-99a3a8"> <strong class="black">Email</strong> </span> {{$data['personal']['email_address']}}
    </div><!--End profile header detail-->

    <hr>
    <!--Main profile detail-->
    <div class="tagInBox">
      <div class="tagBlue"><strong>PROFILE</strong></div>
      <div class="tagDescribe">
        <div class="text-justify"><b class="black"></b> {!! $data['personal']['profile_description'] !!}</div>

      </div>
    </div><!--End main profile detail-->


    @if(sizeof($data['education']))
    <!--EDUCATION section-->
    <hr>
    <?php $i = 0; ?>
    @foreach ($data['education']  as $education)
    <div class="tagInBox">
      <div class="tagBlue">
       @if($i == 0)
       <strong>EDUCATION</strong>
       @else
       &nbsp;
       @endif
       <?php $i++ ?>

     </div>


     <div class="tagDescribe">
 
      <div>
      <b class="black font-mt" >
        {{$education['school_name']}}
      </b>
         , {{$education['location']}} <br>
     <div>{{$education['degree']}} 

        @if($education['gpa'])
        , GPA: {{$education['gpa']}} 
        @endif
      </div>

        {{$education['start_year']}} - 
        @if($education['in_progress'])
        Present
        @elseif ($education['graduation_date'])
        {{ $education['graduation_year'] }}
        @endif
      </div>


      <span class="html education-description">{!!$education['description']!!}</span>

    </div>
  </div><!--END EDUCATION section-->
  <br/>
  @endforeach
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
    <div class="tagBlue">
      <strong>SKILLS</strong>

    </div>
    <div class="tagDescribe ">
      @foreach( $skillArray as $skill)
      <div class="certifyTag col-sm-3">
        {{ $skill }}

      </div>
      @endforeach
    </div>
  </div><!--End SKILLS section-->
  @endif



  <?php $i = 0; ?>
  @if(sizeof($data['work']))
  <!--EDUCATION section-->
  <hr>
  <div class="tagInBox">
    <div class="tagBlue">
      <strong>Experience</strong>

    </div>
    <div class="tagDescribe">
      @foreach ($data['work']  as $work) 
      <div class="para3 was-row">
       @if($i > 0) 
       <p style="padding: 20px;" >&nbsp;</p>
       @endif
      <?php $i++; ?>
        <div class="col-sm-8 no-l"><b class="black font-mt">{{$work['company_name']}}</b></div>
        <div class="col-sm-4 no-r">

         <b class="Fright font-mt"> 
         {{$work['start_year']}} - 
                      @if($work['is_present'])
                      Present
                      @elseif ($work['end_date'])
                      {{ $work['end_year'] }}
                      @endif

          </b>
        </div>
        <div>
          
        </div>
        @if($work['description'])
        <br/>
        <div class="html col-xs-12 no-l no-r">{!!$work['description']!!} 
        <br/> <br/>
        </div>
        @endif
        @if($work['responsibilities'])
        
        <div class="html col-xs-12 no-l no-r">{!!$work['responsibilities']!!}</div>
        @endif
      </div>
      @endforeach
    </div>
  </div><!--End EDUCATION section-->
  @endif
<p style="padding: 20px;" >&nbsp;</p>
  <div class="address2 color-99a3a8">
   {{$data['personal']['address']}}
   <span class="blue">-</span>
   {{$data['personal']['city']}}
   <span class="blue">-</span>
   {{$data['personal']['state']}} {{$data['personal']['zip_code']}}

   @if($data['personal']['phone_no'])<span class="blue">
   &nbsp; | &nbsp; </span><span class="black">Cell </span> {{$data['personal']['phone_no']}} 
   @endif

   @if($data['personal']['email_address'])<span class="blue">
   &nbsp; | &nbsp;  </span><span class="black"> Email </span> {{$data['personal']['email_address']}}</div>
   @endif

 </div>

</div>

@include('/resume_builder/includes/css')

<style>
  .tagDescribe {
    width: 580px;
  }
</style>
</body>
</html>
