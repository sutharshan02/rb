@extends('app')
@section('title','@{{page.title()}}')
@section('style')

<!-- <base href="resume"/> -->
<style>
/*a.back-button:active, a.next-button:active, a.save-button:active {
  transform: scale(0.95);
  transition: all 100ms ease-in-out;
}*/

a.save-button:hover {
  cursor: pointer;
}


.alert-validation:empty, .alert-validation.ng-inactive {
  display: none;
}
.alert-validation {
  margin-top: 10px;
}


/*number input styling*/
.rb-inner-wrapper .form-section input[type="number"] {
    color: #000;
    font-weight: 300;
    font-size: 16px;
}

input[type="number"] {
    border: 1px solid #dae0e6;
    background: transparent;
    width: 100%;
    padding: 10px 10px 10px;
    height: 38px;
    border-radius: 3px;
}

.checkbox {
  padding: 0px;
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

  <?php if(isset(Session::get('user')->user_id)): ?>
  <script>
  app.run(function($sessionStorage, env){
    env.type = 'prod';
   $sessionStorage.user_id = <?php echo Session::get('user')->user_id ?>;
 });
  </script>

<?php else: ?>
 <script>
  app.run(function($sessionStorage, env){
    env.type = 'prod';

 });
  </script>


<?php endif; ?>



<div class="ngview" ng-view></div>


</div>
@include('includes/rb_footer')
@endsection



@section('script')

<script>






</script>
        <script src="{{url('/')}}/dist/js/jquery.min.js"></script>
        <script src="{{url('/')}}/dist/js/owl.carousel.min.js"></script>
        <script>



    

        // script


            $(document).ready(function () {
 
                $(document).on('click', ".owl-itemIn", function () {
                    var idGet = $(this).attr("id");

                    $(".owl-itemIn").removeClass("active");
                    $(this).addClass("active");
                    $(".darkback").show();
          


                    $(".singleItem").each(function (index, el) {
                        if ($(el).data('id') == idGet)
                        {
                            $(el).addClass("active m");
                        } else {
                            if ($(el).hasClass("active m"))
                                $(el).removeClass("active m");
                        }
                    });
                });

                $(".darkback").click(function () {
                    $(".darkback").hide();
                    $(".singleItem").removeClass("active");
                });





            });
        </script>


@endsection
