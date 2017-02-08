@extends('app')
@section('title','The Resume Builder')
@section('style')

@endsection
@section('content') 
    @if($res['status_code']=='1')
    <div class="alert alert-danger">
  <?php echo($res['message']) ?>
</div>
    @elseif($res['status_code']=='0')
    <div class="alert alert-success">
        <?php echo($res['message']) ?>
      </div>
  @endif
  
    <form role="form" action="{{url('register')}}" method="POST" id="frm_01">
        <div class="box-body">
            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="Email">Email<span class="required">*</span></label>
                    <input required type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                    <p class="help-block"></p>
                </div>
            
                <div class="form-group">
                    <label for="Username">Username<span class="required">*</span></label>
                    <input required type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username">
                    <p class="help-block"></p>
                </div>

                <div class="form-group">
                    <label for="Password">Password<span class="required">*</span></label>
                    <input required type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                    <p class="help-block"></p>
                </div>

                <div class="form-group">
                    <label for="Password_Confirm">Confirm Password<span class="required">*</span></label>
                    <input required type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Your Confirm Password">
                    <p class="help-block"></p>
                </div>

                <div class="box-footer text-left">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            
        </div>
    </form>
    
    <form role="form" action="{{url('resume/home')}}" method="POST" id="frm_02">
        <div class="form-group col-md-6">
            <div class="form-group col-xs-8">
                    <label for="Email">Email<span class="required">*</span></label>
                    <input required type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                    <p class="help-block"></p>
                </div>

                <div class="form-group col-xs-8">
                    <label for="Password">Password<span class="required">*</span></label>
                    <input required type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                    <p class="help-block"></p>
                </div>
                <div class="form-group col-xs-8">
                    <a href="{{url('password/reset/view')}}">Forgot Password ?</a>
                </div>
            
                <div class="form-group col-xs-8">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>
    </form>
  
  
  <div class="row">
      <div class="col-md-6">
            <a href="{{url('/')}}"  class="btn btn-success btn-lnk">Back to Home</a>
      </div>
  </div>
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-keyboard="false" data-backdrop="static">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           
                           <h4 class="modal-title" id="myModalLabel" style="font-size: 130%">Forgot Password</h4>
                       </div>
                       <!-- START OF MODAL BODY-->                                  
                       <div class="modal-body" style="padding-left: 10%">
                            <form role="form" method="post" class="form-horizontal" action="{{url('password/reset')}}" id="frm_01">
                                <div class="form-group">
                                    <label for="Email">Email<span class="required">*</span></label>
                                    <input required type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email" style="width: 90%;">
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group">
                                    <label for="Username">Username<span class="required">*</span></label>
                                    <input required type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username" style="width: 90%;">
                                    <p class="help-block"></p>
                                </div>
                              
                               <button type="submit" class="btn btn-info btn-lnk">Create</button>
                            </form>
                       </div>                                        
                       <!-- END OF APPLICATION FORM MODAL BODY -->
                       <div class="modal-footer">
                           <button type="button" class="btn btn-danger btn-lnk" data-dismiss="modal">Close</button>
                       </div>
                   </div><!-- /.modal-content -->
               </div><!-- /.modal-dialog -->
           </div>
@endsection

@section('script')

@endsection
