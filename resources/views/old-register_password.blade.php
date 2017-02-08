@extends('app')
@section('title','The Resume Builder')
@section('style')

@endsection
@section('content') 
    
        <form role="form" action="{{url('register/password')}}" method="POST" id="frm_01">
            <input type="hidden" id="id" name="id" value="{{$user_id}}" />
            <div class="box-body">
                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <p>{{$email}}</p>
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label for="Username">Username<span class="required">*</span></label>
                        <input required type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username" value="{{$username}}">
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
    
@endsection

@section('script')

@endsection
