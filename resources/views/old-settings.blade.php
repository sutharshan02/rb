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
<strong>Hi,</strong> {{$username}}
<p>Your account informations can be change </p>
    <form role="form" action="{{url('settings/update')}}" method="POST" id="frm_01">
        <div class="box-body">
            <div class="form-group col-md-6">
                <input type="hidden" value="{{$user_id}}" name="id" /> 
            
<!--                <div class="form-group">
                    <label for="Username">Username<span class="required">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username" value="{{$username}}">
                    <p class="help-block"></p>
                </div>-->
 <div class="form-group">
                    <label for="Password_Confirm">Current Password<span class="required">*</span></label>
                    <input required type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Your Confirm Password">
                    <p class="help-block"></p>
                </div>

                <div class="form-group">
                    <label for="Password">New Password<span class="required">*</span></label>
                    <input  type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter Your Password">
                    <p class="help-block"></p>
                </div>

                <div class="form-group">
                    <label for="Password_Confirm">Confirm Password<span class="required">*</span></label>
                    <input  type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Your Confirm Password">
                    <p class="help-block"></p>
                </div>
                
               
                <div class="box-footer text-left">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            
        </div>
    </form>

    
Your Subscription <br>
    
Plan: <br>
    
<a href="{{url('plans')}}"><button type="button" class="btn btn-primary">Upgrade</button></a>
   
<a href="{{url('/')}}" class="btn btn-success">Home</a>
@endsection

@section('script')

@endsection
