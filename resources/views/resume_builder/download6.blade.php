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

</head>
<body>

  <div class="container black">

    <div class="certificate text-center">
      <h2 style="font-weight: 900;">{{$data['personal']['first_name']}} {{$data['personal']['last_name']}}</h2>
      <p>{{$data['personal']['city']}} {{$data['personal']['state']}}</p>
      <p>{{$data['personal']['address']}}, {{$data['personal']['zip_code']}}   

        @if($data['personal']['phone_no'])
        <span class="dot"></span>   Mobile:  {{$data['personal']['phone_no']}}  
        @endif
        @if($data['personal']['email_address'])

        <span class="dot"></span>   Email: {{$data['personal']['email_address']}}  
        @endif
      </p>
      <div class="line"></div>
      <h4><strong>Profile</strong></h4>
      <div class="text-justify">{!! $data['personal']['profile_description'] !!}  </div>
      <br /> <br />


      @if(sizeof($data['education']))
      <h4><strong>Education</strong></h4>

      @foreach ($data['education']  as $education) 
      <h5>
      <strong>{{$education['school_name']}}</strong>
        @if($education['location'])
        , {{$education['location']}}
        @endif

      </h5>
      <div class="grayColor">

      {{$education['degree']}}
        @if($education['gpa'])
        , GPA: {{$education['gpa']}} 
        @endif

        <br/>
        {{$education['start_year']}}-

        @if($education['in_progress'])
        Present
        @elseif ($education['graduation_date'])
        {{ $education['graduation_year'] }}
        @endif
      </div>
      @if($education['field_of_study'])
      <h5> {{$education['field_of_study']}}</h5>
      <div class="html education-description">{!!$education['description']!!}</div>
      @endif
      <br/>
      @endforeach
      <br /> <br />


      @endif

      @if($data['skills']['skills'])
      <?php 

      $skills = $data['skills']['skills'];
      $skillArray = explode(",", $skills);
                      // var_dump($skillArray);
      ?>
      <h4><strong>Skills</strong></h4>
      <div class="col-sm-12">
       @foreach( $skillArray as $skill)
       <div class="col-sm-4">

        <div class="">{{$skill}}</div>
      </div>

      @endforeach
    </div>
    <div class="clearfix"></div>
    <br /> <br />
    @endif

    @if(sizeof($data['work']))
    <h4><strong>Experience</strong></h4>
    @foreach ($data['work']  as $work) 
    <h5><strong>{{$work['company_name']}}</strong></h5>
    <div class="grayColor">  {{$work['position']}}</div>
    <h5> {{$work['start_year']}} - 

      @if($work['is_present'])
      Present
      @elseif ($work['end_date'])
      {{ $work['end_year'] }}
      @endif

    </h5>
    @if($work['description'])
    <div class="html">{!!$work['description']!!}</div>
    <br/>
    @endif
    @if($work['responsibilities'])
    <div class="html">{!!$work['responsibilities']!!}</div>
    @endif    <br/>
    @endforeach




    @endif
    <div class="line"></div>

  </div>

</div>

@include('/resume_builder/includes/css')
<style type="text/css">
.line {
  border-bottom: 2px solid #333333;
  margin: 30px 0;
}
.grayColor {
  color: #8d8989;
}
.dot {
  border: 2px solid;
  border-radius: 6px;
  display: inline-block;
  height: 4px;
  margin: 3px 15px;
}

ol, ul {
  list-style-position: inside;
}


p.work-sub-heading {
  font-weight: 500;
  font-size: 1.3rem;
}
</style>
</body>
</html>
