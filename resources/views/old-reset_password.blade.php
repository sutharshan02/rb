@extends('app')
@section('title','The Resume Builder')
@section('style')

@endsection
@section('content') 
    @if (Session::has('reset_msg'))
        <div class="alert-danger">
            {{Session::get('reset_msg')}}
        </div>
    @endif
    <form role="form" action="{{url('password/new')}}" method="POST" id="frm_01">
        <div class="box-body">
            <div class="form-group col-md-6">
            
                <input type="hidden" value="{{$id}}" name="user_id"/>
                <div class="form-group">
                    <label for="Password">New Password<span class="required">*</span></label>
                    <input required type="password" class="form-control" id="password" name="password_new" placeholder="Enter Your New Password">
                    <p class="help-block"></p>
                </div>
                <div class="form-group">
                    <label for="Password">Confirm Password<span class="required">*</span></label>
                    <input required type="password" class="form-control" id="password" name="password_confirm" placeholder="Confirm Your New Password">
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
