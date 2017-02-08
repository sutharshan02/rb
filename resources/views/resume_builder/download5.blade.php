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
  <link href="https://fonts.googleapis.com/css?family=Lora:regular,bold|Open+Sans:regular,bold" rel="stylesheet">
<style>
.template-executive .user-name {
  text-transform: uppercase;
}

.grayBigHeader {
  font-family: 'Open Sans', sans-serif !important;

}

.font-os {
  font-family: 'Open Sans', sans-serif !important;
  
}

.right-contentpanel , .right-contentpanel * {
    font-family: 'Lora', serif ;
}

.right-contentpanel {
  color: #1f1e1e;
}

.bold {
  font-weight: bold;
}

.fs16 {
  font-size: 16px !important;
}
</style>
</head>
<body>

    <div class="container black">
        <div class="certificate">
            <div class="OneContenttype">
                <div class="left-headerpanel"></div>
                <div class="right-contentpanel">
                    <h1 class="color-757474 font-os bold" style="text-transform: uppercase;">{{$data['personal']['first_name']}} {{$data['personal']['last_name']}}</h1>
                    <div class="brownline color-811111 address">
                      {{$data['personal']['address']}}, {{$data['personal']['city']}}, {{$data['personal']['state']}} {{$data['personal']['zip_code']}}    
                      <br />   {{$data['personal']['email_address']}}
                      <br />    {{$data['personal']['phone_no']}}

                  </div>
              </div>
          </div>
          <div class="OneContenttype">
            <div class="left-headerpanel">

                <div class="grayBigHeader bottom bold">Profile</div>
            </div>
            <div class="right-contentpanel">
                <div class="inBoxTo">
                    <p class="text-justify">
                     {!! $data['personal']['profile_description'] !!}  
                 </p>
             </div>
         </div>
     </div>

     <!-- start education -->
     @if(sizeof($data['education']))
     <div class="OneContenttype">
        <div class="left-headerpanel">
            <div class="grayBigHeader bold grayBigHeader-education">Education</div>
        </div>
        <div class="right-contentpanel right-contentpanel-education">
            <div class="2">
              @foreach ($data['education']  as $education) 
              <div class="brownSubHeader color-811111 bold fs16">{{$education['school_name']}} 
                <div class="roghtYear">{{$education['start_year']}}-

                   @if($education['in_progress'])
                   Present
                   @elseif ($education['graduation_date'])
                   {{ $education['graduation_year'] }}
                   @endif

               </div>
           </div>
           <div>
            <div class="color-gray">{{$education['degree']}}
                @if($education['gpa'])
                , GPA: {{$education['gpa']}} <br />
                @endif
            </div>
            {{$education['field_of_study']}}
        </div>
        <div class="html education-description">{!!$education['description']!!}</div>
        <div class="clearfix"></div><br />
        @endforeach
        


    </div>
</div>
</div>
@endif
<!-- end education -->

<!-- start skills -->
@if($data['skills']['skills'])
<?php 

$skills = $data['skills']['skills'];
$skillArray = explode(",", $skills);
                      // var_dump($skillArray);
?>
<div class="OneContenttype">
    <div class="left-headerpanel">
        <div class="grayBigHeader bold grayBigHeade-skills">Skills</div>
    </div>
    <div class="right-contentpanel">
        <div class="inBoxTo2">
            <div class="row">
                   <?php $i = 0; ?>
                   @foreach( $skillArray as $skill)
                <div class="col-sm-4">
                   <p>{{ $skill }}</p> 

                   <?php $i++; ?>
             
            </div>
                @endforeach
        </div>
    </div>
</div>
</div>
@endif
<!-- end skills -->


<!-- start work -->
@if(sizeof($data['work']))
<div class="OneContenttype">
    <div class="left-headerpanel">
        <br /> <br /> <br /> <br /> <br />
        <div class="grayBigHeader bold grayBigHeader-experience">Experience</div>
    </div>
    <div class="right-contentpanel">
        <div class="inBoxTo2">
        
            @foreach ($data['work']  as $work) 
            <div class="was-row table">
                <div class="col-xs-8 no-l">
                    <p >
                        <b class="color-811111 bold fs16">{{$work['company_name']}}</b><br />
                        {{$work['position']}}
                    </p>
                    <p>

                    </p>
                </div>
                <div class="col-xs-4 no-r">
                    <b class="Fright bold"> {{$work['start_year']}} - 

                        @if($work['is_present'])
                        Present
                        @elseif ($work['end_date'])
                        {{ $work['end_year'] }}
                        @endif

                    </b>
                </div>
            </div>

            @if($work['description'])
            <div class="html">{!!$work['description']!!} <br/><br/></div>
            @endif
            @if($work['responsibilities'])
            <div class="html">{!!$work['responsibilities']!!}</div>
            @endif
            <br />
            @endforeach
            
        </div>
    </div>
</div>
@endif
<!-- end work -->

</div>
</div>

@include('/resume_builder/includes/css')

<style>
.inBoxTo:last-child {
    border-bottom: 2px solid #333;
    margin-bottom: 0px;
}

.inBoxTo, .inBoxTo2 {
    border-top: 2px solid #333;
    /* padding: 45px 0 !important; */
    padding:  40px 0;
}

.inBoxTo2 {
    padding: 40px 0;
}

.grayBigHeader.bottom {
    bottom: 48px;
}


.right-contentpanel.right-contentpanel-education{
  padding-top: 40px;
  padding-bottom: 30px;
}

.grayBigHeader.grayBigHeader-education, .grayBigHeader.bold.grayBigHeade-skills {
  top: 40px;
  position: absolute;
}

.grayBigHeader.bold.grayBigHeader-experience {
  top: 93px;
  position: absolute;
}

.brownline.address {
  /* padding-top: 10px; */
  padding-bottom: 40px;
}
</style>

</body>
</html>
