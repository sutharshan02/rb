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
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,400i,700,700i" rel="stylesheet"> 
</head>
<body>

  <div class="container black">
    <div class="certificate">
      <h1>{{$data['personal']['first_name']}} {{$data['personal']['last_name']}}</h1>
      <div class="introDoc"></div>



      <div class="certificateRow">
        <div class="logName">Profile</div>
        <div class="ContentLog text-justify">
          {!! $data['personal']['profile_description'] !!} 
        </div>
      </div>


      @if(sizeof($data['education']))
      <div class="certificateRow">
        <div class="logName"><h4>Education</h4></div>
        <div class="ContentLog">
          <div class="row">
           @foreach ($data['education']  as $education)
           <div class="col-sm-4">
            <h4>{{$education['school_name']}}  </h4>
            <div class="grayColor">


              <div class="school-row">{{$education['degree']}} 
                     
                            </div>
                            <div class="school-row">       @if($education['gpa'])
                            GPA: {{$education['gpa']}} 
                            @endif
</div>
              <div class="school-row">
                {{$education['field_of_study']}}
              </div>

              <div class="school-row">{{$education['start_year']}} - 
                            @if($education['in_progress'])
                            Present
                            @elseif ($education['graduation_date'])
                            {{ $education['graduation_year'] }}
                            @endif</div>


              <div class="html school-row text-justify">{!!$education['description']!!}</div>

              <br />
            </div>
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
    <div class="certificateRow ">
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
    <div class="certificateRow">
      <div class="logName"><h4>Experience</h4></div>
      <div class="ContentLog">
        @foreach ($data['work']  as $work) 
        <div class="companyBox">
          <h4>{{$work['company_name']}} </h4>                   
          <h4 class="i">{{$work['position']}}</h4>
          @if($work['description'])

          <div class="html description-row">{!!$work['description']!!}</div>
          @endif
          @if($work['responsibilities'])
 
          <div class="html description-row">{!!$work['responsibilities']!!}</div>
          @endif
          <b>{{$work['start_year']}} - 

            @if($work['is_present'])
            Present
            @elseif ($work['end_date'])
            {{ $work['end_year'] }}
            @endif</b>
          </div>
          @endforeach



          
        </div>
      </div>
      @endif







    </div>
  </div>
  @include('/resume_builder/includes/css')
<style>

  * {
    font-family: 'Merriweather', serif;
  }

  .school-row {
    padding-bottom: 5px;
    padding-top: 5px;
  }

  .description-row {
    padding-top: 5px;
    padding-bottom: 5px;
  }

  .i {
    font-style: italic;
  }
</style>
</body>
</html>
