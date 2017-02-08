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
    font-family: serif;
  }

  /*hr*/
  tr.hr td {
    border-bottom: 1px dashed #044875;
  }

  tr.hr-up td {
    border-top: 1px dashed #044875;
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
    font-style: italic;
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
    font-style: italic;
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
    font-style: italic;;
    font-weight: bold;
  }

  .education .position , .education .description{
    color: #888;
  }

  *, p, h1, h2, h3, h4, h5, h6, p.name {
    color: #444;
  }


  </style>
</head>

<body >
  <div class="" sytle="width: 100%;"></div>
  <table cellspacing="0" class="main">
    <tr>
      <th><p class="name" style="color: #444; text-transform: uppercase;">{{$data['personal']['first_name']}}  {{$data['personal']['last_name']}}</p>
        <p class="name" style="maring-bottom: 20px;"><br/></p>
      </th>

      <th class="contact">

<!--         <p class="phone"> {{$data['personal']['phone_no']}}</p>
        <p class="email"> {{$data['personal']['email_address']}}</p>
      -->
    </th>

  </tr>
</table >

<table cellspacing="0" class="main">
  <tr class="">
    <td class="title"><p>Profile</p></td>
    <td class="description"><p>{{$data['personal']['profile_description']}} </p></td>

  </tr>




  <tr class="">
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

<tr class='<?php echo ($i > 0) ? "secondery" : "";  ?>'>
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




<?php $i = 0; ?>
@foreach ($data['education']  as $education)  
<tr class="education <?php echo ($i > 0) ? "secondery" : "";  ?>">
  <td class="title"><p><?php echo ($i == 0) ? "Education" : "";  ?></p></td>
  <td class="description job">
    <p class="company">{{$education['school_name']}}</p>
    <p class="position">{{$education['degree']}}</p>
    <p class="description">{{$education['field_of_study']}}</p>

  </td>

</tr>
<?php $i++; ?>
@endforeach





</table>

<div class=""></div>
</body>

</html>
