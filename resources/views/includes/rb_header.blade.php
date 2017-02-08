  <section class="rb-navgation">
            <div class="container">
                <div class="row">
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
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href ="{{url('/')}}">Home</a></li>
                                <li><a href ="{{url('/about')}}">About</a></li>
                                <li><a href ="{{url('/blog')}}">Resume Tips</a></li>
                                <li><a href ="{{url('plans')}}">Plans</a></li>
                                <li><a href ="{{url('/contact')}}">Contact</a></li>
                                <li class ="build-your"><a class="hover-shadow" style="border: 1px solid #1d7df3;" href="{{url('/resume/create#/')}}">Build your resume now</a></li>
                                <?php if (Session::get('user')): ?>
                                  <li class="login-button"><a href="{{url('logout')}}">Logout</a></li>
                                <?php else: ?>
                            <li class="login-button"><a class="hover-shadow" href="{{url('user/create')}}">Login</a></li>
                               <?php endif; ?>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>
            </div>
        </section>
    