@extends('app')
@section('title','Step 1')
@section('style')



@endsection



@section('content')

<?php if(Session::has('user')) { ?>
	@include('includes/rb_user_logged_header')


	<?php }else{?>   
	@include('includes/rb_header')
	<?php }?>

	<style>
	input.download_inputs {
		display: none;
	}

	.btn {
		margin: 5px;
	}
	table {
		width: 100%;
	}
	.download-btn, .download-btn-form {
		display: inline-block;
	}
	</style>
	<section class="cvs" ng-controller="AppCtrl">


		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="cv-item" >
						<a class="next-button btn btn-info" href="{{url('/')}}/resume/new" ng-click="create()">create new</a>

					</div>
					<?php //var_dump($data);?>
					<?php //var_dump($data->$resume_data);?>



					<table class="table" id="cv-list-table">
						<thead>
							<tr>
								<th>Resume ID</th>
								<th>Template ID</th>
								<th>Resume Name</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($data as $cv) 
				
							<tr id="cv-item-{{$cv['resume_id']}}">
								<td>{{ $cv['resume_id'] }}</td>
								<td>{{ $cv['template_id'] }}</td>
								<td>{{ $cv['resume_name'] }}</td>
								<td class="text-center">
									<a href="{{url('resume/edit')}}?resume_id={{ $cv['resume_id'] }}" class="next-button btn btn-warning" >edit</a>
									<button class="next-button btn btn-danger" ng-click="delete( {{ $cv['resume_id'] }})">delete</button>
									<form class="download-btn-form" method="get" id="download_form" action="{{url('resume/download')}}">
										<input class="download_inputs" type="text" name="resume_id" ng-value="{{ $cv['resume_id'] }}">
										<input class="download_inputs" type="text" name="template_id" ng-value="{{ $cv['template_id'] }}">
										<button class="btn btn-success download-btn" type="submit">Download</button>
									</form>
								</td>
							</tr>

							@endforeach

						</tbody>
					</table>
					<?php 
					echo $data->links();
					?>

				</div>
			</div>    

		</div>





	</section>

	<!-- <div class="loading-spinner" ng-show="loading" >
		<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
		<span class="sr-only">Loading...</span>

	</div> -->
	<!-- <section ng-show="loadingError" style="min-height: 80vh;padding:50px;">

		<div class="server-error">Internal Server error, please refresh and try again.. <br/>
			If this error persists, please contact the site administrator.. </div>
		</section>
 -->
		<style>
		.cv-item {
			/*border: 1px solid #e1e1e1;*/
			width: 200px;
			margin: 10px;
			/*float: left;*/
			/*display: inline-block;*/
		}

		.cvs {
			display: block;

		}

		.ngview.ng-enter {
			opacity: 0;
			transition-delay: 50ms;
			transform: scale(1.1);

		}

		.ngview.ng-enter-active  {
			opacity: 1;
			transform: scale(1);

		}

		.ngview.ng-leave {
			opacity: 1;
			transform: scale(1);
		}

		.ngview.ng-leave-active {
			opacity: 0;
			transform: scale(.9);
		}

		</style>	




		@include('includes/rb_footer')
		@endsection



		@section('script')

		@endsection
