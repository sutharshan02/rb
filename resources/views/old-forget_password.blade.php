@extends('app')
@section('title','The Resume Builder')
@section('style')
<style>
    #forgetForm{
    padding: 50px;
    }
    </style>
@endsection
@section('content')

    @if (Session::has('forget_msg'))
        <div class="alert-success">
            {{Session::get('forget_msg')}}
        </div>
    @endif
   

   
    
    
    <form id="forgetForm" role="form" method="post" class="form-horizontal" action="{{url('password/reset')}}" >
        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="Email">Email<span class="required">*</span></label>
                <input required type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" style="width: 90%;">
                <p class="help-block"></p>
            </div>

            
            <div class="row">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info btn-lnk">Submit</button>
                </div>
                <div class="col-md-4">
                    <a href="{{url('user/create')}}"  class="btn btn-success btn-lnk">Back</a>
                </div>
            </div>
        </div>
    </form>
    
    
@endsection

@section('script')

@endsection
