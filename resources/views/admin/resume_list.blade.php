@extends('app')
@section('title','The Resume Builder - Admin')
@section('style')

<link href="{{url('/') . '/'}}dist/css/style.css" rel="stylesheet" type="text/css">
<link href="{{url('/') . '/'}}dist/css/res.css" rel="stylesheet" type="text/css">

<style>
button.pdf {
	background-color: transparent;
	border: none;
}
.td {
	vertical-align: middle;
	/*border: 1px solid;*/
}
.table.dashboard-table  {
	/*border: 1px solid black;*/
}
.table.dashboard-table  .tr {
	/*border: 1px solid green;*/
}
.table.dashboard-table  .tr .td {
	/*border: 1px dashed red;*/
	vertical-align: middle;
}

.table.dashboard-table  .tr .td  a,
.table.dashboard-table  .tr .td  p{
	/*border: 1px dashed brown;*/
	margin: 0;
	/*height: 100%;*/
	display: inline-block;
	display: table-cell;
}
.table.dashboard-table  .tr .td  a{
height: 42px;

}
a.delete {
	background-position-y: 8px;
}
a.envilop {
	background-position-y: 8px;
}
a#download_button {
	background-position-y: 9px;
}

.peg-button {
  display: block;
  text-align: center;
  color: #fff;
  font-weight: 300;
  font-size: 16px;
  border-radius: 3px;
  margin-top: 50px;
  padding: 2px 0px;
  width: 94px;
  background-repeat: repeat-x;
  background-size: auto 100%;
  text-transform: uppercase;
}

.buttons-holder {
        display: flex;
    justify-content: space-around;
}
</style>
@endsection



@section('content')

<div class="full_page_wrap">

<?php if(Session::has('user')) { ?>
	@include('includes/rb_user_logged_header')


	<?php }else{?>   
	@include('includes/rb_header')
	<?php }?>



	<div class="container" ng-controller="AppCtrl">
<!--		<div class="row">
			<div class="col-xs-12">
				<a class="next-button btn btn-info" href="{{url('/')}}/resume/new" >create new</a>
			</div>
		</div>-->
		<div class="row">
                    @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Alert!</strong>{{Session::get('success_message')}}
                    </div> 
                    @endif
                     @if (Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Alert!</strong>{{Session::get('error_message')}}
                    </div> 
                    @endif
			<div class="col-md-6">
				<br /><br />
				<div class="MainHeader">User Resumes</div>
			</div>
			<div class="col-md-6 invisible">
				<div class="searchBox">
					<span>Search </span>
					<input type="search" />
				</div>
			</div>
			<div class="col-md-10">
                            @if(!empty($data))
				<div class="table dashboard-table">

					<!--table rows start-->
					<div class="tr">
						<div class="th">Resume name</div>
						<div class="th">Template</div>
						<div class="th">Created date</div>
						<div class="th"></div>
					</div><!--End table rows-->


					@foreach ($data as $user) 
					<!--table rows start-->
					<div class="tr">
						
						<div class="td ResumeTitle">@if(!empty($user['resume_name'])){{$user['resume_name']}} @else resume @endif</div>
						
						<div class="td ResumeTitle">{{$user['template_id']}}</div>
						

						<div class="td CreatedDate">
                                                    <p>{{$user['created_at']}}</p>
                                                </div>
						
						<div class="td">
                                                    <form class="download-btn-form" method="get" id="download_form" action="{{url('resume/download')}}">
                                                        <input class="download_inputs hidden" type="text" name="resume_id" ng-value="{{ $user['resume_id'] }}">
                                                        <input class="download_inputs hidden" type="text" name="template_id" ng-value="{{ $user['template_id'] }}">
                                                        <button class="hidden" class="pdf" type="submit"></button>
                                                    </form>
                                                    <a id='download_button' class="pdf" href="{{url('admin/resume/download') . "?resume_id=" . $user['resume_id'] . "&template_id=" . $user['template_id']}}"></a>
                                                </div>
					</div><!--End table rows-->
					@endforeach
                                    
                                            
                                       
                                            <div class="tr">
                                                <div class="buttons-holder">
                                           
                                            @if($data->previousPageUrl())
                                            <div class="td">
                                                <button class="btn btn-info peg-button" onclick="window.location='{{$data->previousPageUrl()}}'" class="">Prev</button>
                                            </div> &nbsp;&nbsp;&nbsp;&nbsp;
                                            @endif
                                            @if($data->nextPageUrl())
                                             <div class="td">
                                                <button class="btn btn-info peg-button" onclick="window.location='{{$data->nextPageUrl()}}'" class="">Next</button>
                                             </div>
                                            @endif
                                        </div>
                                            </div>

				</div>
                            @else
                            {{$message}}
                            @endif
				<div class="clearfix"></div>

			</div>
		</div>
	</div>



<!--Delete button warning pop up box-->
<script type="text/ng-template" id="deleteConfirmModal.html">
					<div class="modal-body">
					<div class="modbod">
						<img src="{{url('/dist/img/werning.png')}} " />
						<div class="centText">You are sure to want to delete this?</div>

						<div class="btnCenterBox">
							<a class="blueBtn" ng-click="ok()">Yes</a>
							<button type="button" class="grayebtn" ng-click='cancel()' >No</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
</script>





</div>

	@include('includes/rb_footer')
	@endsection



	@section('script')

	<script>
	$(function(){
		$('#confirm-delete').on('show.bs.modal', function(e) {
			// $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
			console.log($(e.relatedTarget).data('href'));
		});

	});
	</script>

	@endsection

