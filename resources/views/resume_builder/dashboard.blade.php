@extends('app')
@section('title','The Resume Builder - Account')
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
		<div class="row">
			<div class="col-xs-12">
				<a class="next-button btn btn-info" href="{{url('/')}}/resume/new" >create new</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<br /><br />
				<div class="MainHeader">RESUME DASHBOARD</div>
			</div>
			<div class="col-md-6 invisible">
				<div class="searchBox">
					<span>Search </span>
					<input type="search" />
				</div>
			</div>
			<div class="col-md-10">

				<div class="table dashboard-table">

					<!--table rows start-->
					<div class="tr">
						<div class="th">Resume Title</div>
						<div class="th">Created Date</div>
						<div class="th">Modified Date</div>
						<div class="th"></div>
					</div><!--End table rows-->


					@foreach ($data as $cv) 
					<!--table rows start-->
					<div class="tr">
						@if($cv['resume_name'] == '')
						<div class="td ResumeTitle"><a href="{{url('resume/edit')}}?resume_id={{ $cv['resume_id'] }}"> Edit Draft</a></div>
						@else
						<div class="td ResumeTitle"><a href="{{url('resume/edit')}}?resume_id={{ $cv['resume_id'] }}">{{ $cv['resume_name'] }}</a></div>
						@endif

						<div class="td CreatedDate">

							<p>{{ $cv['created_at']}}</p>
							</div>
						<div class="td ModifiedDate">{{ $cv['updated_at']}}</div>
						<div class="td">
							<!-- <a href="" class="pdf"></a> -->
							<form class="download-btn-form" method="get" id="download_form" action="{{url('resume/download')}}">
								<input class="download_inputs hidden" type="text" name="resume_id" ng-value="{{ $cv['resume_id'] }}">
								<input class="download_inputs hidden" type="text" name="template_id" ng-value="{{ $cv['template_id'] }}">
								<button class="hidden" class="pdf" type="submit"></button>
							</form>

							<?php 

								$path = url('resume/download') . "?resume_id=" . $cv['resume_id'] . "%26template_id=" . $cv['template_id'];
								$pathLink = "<a href='" . $path . "'> Link </a>";
							
                                                            $subscription = Session::get('sub_object');
                                                            //print_r($subscription);

                                                            $dev = false;
                                                        ?>

                                                        @if((@$subscription['plan']!='0'&&@$subscription['failed']=='0') || @$dev)
                                                        
                                                        <a id='download_button' class="pdf" href="{{url('resume/download') . "?resume_id=" . $cv['resume_id'] . "&template_id=" . $cv['template_id']}}"></a>
                                                        <a href="{{url('send/email/'.$cv['resume_id'].'/'.$cv['template_id'].'')}}" class="envilop"></a>
                                                        @else
                                                        <a id='download_button' class="pdf" href="{{url('plans')}}"></a>
                                                        <a 
							href="{{url('plans')}}" 
							class="envilop"></a>
                                                        @endif
							<!-- <a href="" class="delete" data-toggle="modal" data-href="delete( {{ $cv['resume_id'] }})" data-target="#confirm-delete"></a> -->
							<a href="" class="delete" ng-click="openDelete( {{ $cv['resume_id'] }})" ></a>
							<!-- <button class="next-button btn btn-danger" ng-click="delete( {{ $cv['resume_id'] }})">delete</button> -->

						</div>
					</div><!--End table rows-->
					@endforeach

					<?php 
					echo $link->links();
					?>

				</div>
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
