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
    padding-top: 30px;
    padding-bottom: 30px;
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

  </style>
</head>

<body >
  <div class="" sytle="width: 100%;"></div>
  <table cellspacing="0" class="main">
    <tr>
      <th colspan="2" style="height: 40px;">
        <p class="name" style="text-transform: uppercase;"><span class="black">{{$data['personal']['first_name']}}<span>  <span class="blue">{{$data['personal']['last_name']}}</span></p>
      </th>
    </tr>


    <tr>
      <th  colspan="2" style="text-align: left;">
        <p style="text-align: left;">
          
          <span class="gray"> {{$data['personal']['address']}} - {{$data['personal']['city']}} - {{$data['personal']['state']}} {{$data['personal']['zip_code']}} </span>

        </p>
      </th>

    </tr>
    <tr class="hr">
      <th  colspan="2" style="text-align: left; height: 25px;">
        <p style="text-align: left;">
          <span class="black">Cell </span>
          <span class="gray"> {{$data['personal']['phone_no']}} |</span>
          <span class="black"> Email </span>
          <span class="gray"> {{$data['personal']['email_address']}}</span>
        </p>
      </th>

    </tr>



  </table >

  <table cellspacing="0" class="main">
    <tr class="">
      <td class="title"><p>Profile</p></td>
      <td class="description"><p>{{$data['personal']['profile_description']}} </p></td>

    </tr>




    <?php $i = 0; ?>
    @foreach ($data['education']  as $education)  
    <tr class="education <?php echo ($i > 0) ? "secondery" : "hr-up";  ?>">
      <td class="title"><p><?php echo ($i == 0) ? "Education" : "";  ?></p></td>
      <td class="description job">
        <p class="company">{{$education['school_name']}}</p>
        <p class="position">{{$education['degree']}}</p>
        <p class="description">{{$education['field_of_study']}}</p>

      </td>

    </tr>
    <?php $i++; ?>
    @endforeach





    <tr class="hr-up">
      <td class="title"><p>Skills</p></td>
      <td class="description">
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

  <?php $i = 0; ?>
  @foreach ($data['work']  as $work) 
  <?php
                      // check dates
  $start = substr($work['start_date'], 0, 4);
  $end = substr($work['end_date'], 0, 4);
  $start_date = ($start == "0000") ? "" : $start;
  $end_date = ($end == "0000") ? "" : $end;

  ?>

  <tr class='<?php echo ($i > 0) ? "secondery" : "hr-up";  ?>'>
    <td class="title"><p><?php echo ($i == 0) ? "Experience" : "";  ?></p></td>
    <td class="description job">


      <table>
        <tr class="work-title">
          <td>
            <p class="company i">{{$work['company_name']}}</p>

          </td>
          <td style="text-align: right;">

            <p style="display: inline-block; width: 100%; height: 100%;" class="duration i">{{ $start_date }} - {{ $end_date }} 
              <?php if($work['is_present']): ?>
              <span> to Date</span>
              <?php endif; ?>
            </p>
          </td>
        </tr>
        <tr class="work-info">

          <td colspan="2">
            <p class="position i"> {{$work['position']}} </p>
            <p class="description">{{$work['description']}}</p>

          </td>
        </tr>


      </table>
    </td>

  </tr>
  <?php $i++; ?>
  @endforeach



<tr class="">
      <td  colspan="2" style="text-align: left; height: 10px;">
        <p style="text-align: center; display: flex; justify-content: space-between;">
          <span class="block gray"> {{$data['personal']['address']}} - {{$data['personal']['city']}} - {{$data['personal']['state']}} {{$data['personal']['zip_code']}} | </span> 
          

          <span class="block black">Cell </span>
          <span class="block gray"> {{$data['personal']['phone_no']}} |</span>
          
          <span class="block black"> Email </span>
          <span class="block gray"> {{$data['personal']['email_address']}}</span>
        </p>
      </td>

    </tr>



</table>

<style>
.block  {
  display: inline-block;

</style>

<!-- <div class="hr"></div> -->
</body>

</html>
