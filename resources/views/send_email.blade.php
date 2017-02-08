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
			<div class="col-md-6">
				<br /><br />
				<div class="MainHeader">Send Email</div>
			</div>
			
			<div class="col-md-10">

				<div class="table dashboard-table">
                                    
                                        <div class="col-xs-12 col-lg-9">
                                            <form name="form" method="POST" action="{{url('post/email')}}">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                      <lable>Company email *</lable>
                                                      <input  type="email"  class="form-control" id="email" name="email" value="" >
                                                    </div>
                                                    <div class="form-group col-md-12" >
                                                      <lable>Cover letter *</lable>
                                                      <input  type="textarea" class="form-control" id="cover_letter" value="{{$cover_letter}}" name="cover_letter" style="height:150px">
                                                    </div>
                                                   <input type="hidden" name="resume_id" value='{{$resume_id}}'>
                                                   <input type="hidden" name="template_id" value='{{$template_id}}'>
                                                   
                                                </div>
                                          <div class="col-xs-12 text-center">
                                            <button type="submit" class="btn btn-success" >Submit</button>
                                          </div>
                                       
                    
                                        @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Success!</strong> {{Session::get('success')}}
                                        </div>
                                        @endif
                                        @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Success!</strong> {{Session::get('error')}}
                                        </div>
                                        @endif
                
                                    </form>
                                 </div>   
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

