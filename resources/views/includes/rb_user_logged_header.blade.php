 <section class="rb-navgation">
      <div class="container">
                <div class="row" style="margin-left: 0px; margin-right: 0px;">
          <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('/') . '/'}}assets/images/logo.png" alt="" class="img-responsive logo-image"></a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav navbar-right logged-navigation">
                  <?php $user_role = session()->get('user'); if($user_role['role'] == 1){?>
                      <li><a href="{{url('admin/dashboard')}}">Dashboard </a></li>
                 <?php }else{ ?>
                <li><a href="{{url('dashboard')}}">Resume Account </a></li>
                 <?php } ?>
                <?php
                    $subscription = Session::get('sub_object');
                    //print_r($subscription);
                ?>
                @if(@$subscription['plan']=='0'||@$subscription['failed']=='1')<li><a href="{{url('plans')}}">Activate</a></li>@endif
                 <?php $user_role = session()->get('user'); if($user_role['role'] != 1){?>
                <li><a href="{{url('settings')}}">Change Password</a></li>
                 <?php }elseif($user_role['role'] == 1){ ?>
                   <li><a href="{{url('admin/settings')}}">Change Password</a></li>  
                 <?php } ?>
                <li class="nav-user-details">
                  <p>
                    Welcome, <br/>
                    <span>{{Session::get('user')->username}}</span>
                  </p>
                </li>
                <li class="login-button"><a class="hover-shadow" href="{{url('/logout')}}">LogOUT</a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </nav>
        </div>
      </div>
    </section>