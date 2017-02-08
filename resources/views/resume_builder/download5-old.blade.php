<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <title></title>

  <style type="text/css">
  td, th { page-break-inside: avoid; }
  body{
    padding:0px;
    margin:0px;
    /*for dev*/
    /*width: 730px; */
  }

  * {
    font-family: sans-serif;
  }

  /*hr*/
  tr.hr td, tr.hr th {
    border-bottom: 1px solid #aaa;
  }

  tr.hr-up > td {
    border-top: 1px solid #aaa;
  }

  div.hr {
    width: 100%;
    height: 1em;
    background: #034976;
  }

  tr.hr td{
    padding-bottom: 30px;
  }

  tr.hr + tr> td {
    /*border:1px solid red;*/
    padding-top: 30px;
  }


  table.main > tbody > tr > td
  /*,tr td*/
  {
    padding-top: 10px;
    padding-bottom: 10px;
    /*border: 1px solid red;*/

  }

  table.main > tbody > tr.secondery > td{
    /*border: 2px solid green;*/
    padding-top: 0px;
  }


  /*end hr*/

  /*setting color*/

  * {
    color: #444;
  }

  /*blue*/
  p.name,   th.contact p {

    color: #034976;

  }


  /*end setting color*/


  /*setting sizes*/
  p {
    font-size: 12px;
    line-height: 17px;
    margin-bottom: 0px;
  }
  p.name {
    font-size: 30px;
    font-weight: bold;


  }



  th.contact p, td.title p{
    font-size: 15px;
    font-weight: normal;
    font-style: normal;
    font-family: sans-serif;
  }

  /*end setting sizes*/

  tr {vertical-align: top;}
  p {
    margin-top: 0px;
  }
  table.main tr td.title {
    width: 20%;
  }
  p.name {


    text-align: left;
  }


  th.contact p{

    text-align: right;
  }

  table.main {
    padding: 70px 90px;
    /*padding-bottom: 20px;*/
    width: 100%;
  }

  table.main:first-of-type {
    padding-bottom: 0px;
  }

  table.main:last-of-type {
    padding-top:0px;
  }


  /*work*/
  .i {
    font-style: normal;
    font-family: sans-serif;
  }
  .work-title .company {
    font-weight: bold;
  }

  .duration {
    font-weight: bold;
  }

  .work-info .position {
    font-weight: bold;
    color: #888;
  }

  .education {
    font-style: normal;
    font-family: sans-serif;;
    font-weight: bold;
  }

  .education .position , .education .description{
    color: #888;
  }


  .black, .black * {
    color: #444;
    font-family: sans-serif;

  }

  .gray, .gray * {
    color: #777;
    font-family: sans-serif;
    font-weight: 200;

  }

  .blue, .blue * {
    color: #2687ff;
    font-family: sans-serif;
  }



  .name *{
    font-weight: 200;
  }

  .name .blue, .name .blue * {
    font-weight: 600;
  }

  td.title * {
    font-weight: 400;
    color: #2687ff;
    font-style: normal;
    text-transform: uppercase;
  }

  .education td.description p {
  font-weight: 200;
}

.red, .red * {
  color: #811111;
}

.dark-gray, .dark-gray * {
  color: #777 !important;
}

.f-normal, .f-normal * {
  font-weight: normal;
}

.f-bold, .f-bold * {
  font-weight: bold;
}

 * {

  font-family: Georgia, Times, "Times New Roman", serif !important;
}

.title p,  p.name, p.name * {

  font-family: Arial, sans-serif !important;
}


td.title {

  padding-top: 30px;
}

td.bottom-padding {
  /*border-top: 1px solid #aaa;*/
  padding-bottom: 30px !important;
  /*border-bottom: 2px solid blue;*/
}

td.title p {
  font-size: 18px;
}

td.title p {
  text-align: right;
  padding-right: 20px;
}

.no-padding, 

table.main > tbody > tr > td.no-padding {
  padding: 0px 0px !important;
}

.no-padding-all, .no-padding-all * {
  padding: 0px 0px !important;
}

table.main > tbody > tr > td.no-padding {
  padding: 0px;
}

table.main.profile-desc {
  padding: 10px 90px;
}

table.main > tbody > tr > td.hr-up {
  border-top: 1px solid #aaa;
  padding-top: 30px !important;
}

table.main > tbody > tr > td.title {
  padding-top: 30px !important;
}


  </style>
</head>

<body >
  <div class="" sytle="width: 100%;"></div>
  <table cellspacing="0" class="main">
    <tr>
      <th width="37%"></th>
      <th colspan="2" style="height: 40px;">
        <p class="name f-bold" style="text-transform: uppercase;"><span class="dark-gray">{{$data['personal']['first_name']}} {{$data['personal']['last_name']}}</span></p>
      </th>
    </tr>


    <tr>
       <th width="37%"></th>
      <th style="text-align: left;">

        <p style="text-align: left;">
          
          <span class="red f-normal"> {{$data['personal']['address']}} - {{$data['personal']['city']}} - {{$data['personal']['state']}} {{$data['personal']['zip_code']}} </span>

        </p>

      </th>

    </tr>
    <tr class=" f-normal ">
       <th width="37%"></th>
      <th  style="text-align: left; height: 25px;">
      
        <p class="email red">  {{$data['personal']['email_address']}}</p>
        <p class="red"> {{$data['personal']['phone_no']}} </p>
      </th>

    </tr>



  </table >

  <table cellspacing="0" class="main profile-desc">
    <tr class="">
      <td colspan="2" class="description"><p>{{$data['personal']['profile_description']}} </p>
      </td>

    </tr>

</table>
<table cellspacing="0" class="main">
  <tr class="no-padding-all">
    <td width="37%"></td>
    <td></td>
  </tr>



  <?php $i = 0; ?>
  @foreach ($data['work']  as $work) 
  <?php
                      // check dates
  $start = substr($work['start_date'], 0, 4);
  $end = substr($work['end_date'], 0, 4);
  $start_date = ($start == "0000") ? "" : $start;
  $end_date = ($end == "0000") ? "" : $end;

  ?>

  <tr class=''>
    <td class="title dark-gray"><p><?php echo ($i == 0) ? "Experience" : "";  ?></p></td>
    <td class="description job <?php echo ($i > 0) ? "secondery" : "hr-up";  ?>
      {{ (sizeof($data['work']) == $i + 1) ? 'bottom-padding' : ''}}">


      <table>
        <tr class="work-title">
      

           <td col-span="2">
              <p class="job-info"><span class="red bold company i">{{$work['company_name']}}</span>, {{$work['position']}}, 
                {{ $start_date }} - {{ $end_date }} 
              <?php if($work['is_present']): ?>
              <span> to date</span>
              <?php endif; ?>
              </p>

            </td>
         
        </tr>
        <tr class="work-info">

          <td colspan="2">
    
            <p class="description">{{$work['description']}}</p>

          </td>
        </tr>


      </table>
    </td>

  </tr>
  <?php $i++; ?>
  @endforeach


@if($data['skills']['skills'])

  <tr class="">
      <td class="title dark-gray"><p>Skills</p></td>
      <td class="description  hr-up bottom-padding">
        <?php 

        $skills = $data['skills']['skills'];
        $skillArray = explode(",", $skills);
                      // var_dump($skillArray);
        ?>

        <?php foreach($skillArray as $s): ?>
        <p>
          <?php echo $s; ?>
        </p>

      <?php endforeach; ?>

    </td>

  </tr>

  @endif


    <?php $i = 0; ?>
    @foreach ($data['education']  as $education)  
    <tr class="education ">
      <td class="title dark-gray"><p><?php echo ($i == 0) ? "Education" : "";  ?></p></td>
      <td class="description job <?php echo ($i > 0) ? "secondery" : "hr-up";  ?>
        {{ (sizeof($data['education']) == $i + 1) ? 'bottom-padding' : ''}} ">
        <p class="company"><span class="red f-bold">{{$education['school_name']}}</span>, @if($education['graduation_date'])
          {{ substr($education['graduation_date'],0,4) }}
          @elseif ($education['in_progress'])
          still following
          @endif</p>
        <p class="position">{{$education['degree']}}</p>
        <p class="description">{{$education['field_of_study']}}</p>
      </td>
    </tr>
    <?php $i++; ?>
    @endforeach





  





</table>

<style>
.block  {
  display: inline-block;

</style>

<!-- <div class="hr"></div> -->
</body>

</html>
