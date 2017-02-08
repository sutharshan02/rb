<!DOCTYPE html>
<html lang="en" ng-app="myapp">
    <head>


          <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <!-- fevicon -->
        <link href="{{url('/') . '/'}}assets/images/fevicon.png" rel="shortcut icon"/>
        <link href="{{url('/') . '/'}}assets/images/fevicon.png" rel="apple-touch-icon"/>
        <link href="{{url('/') . '/'}}assets/images/fevicon.png" rel="shortcut icon" type="{{url('/') . '/'}}assets/images/ico"/>
        <link href="{{url('/') . '/'}}assets/images/fevicon.png" rel="icon" type="image/ico"/>
        <!-- css -->
        <link href="{{url('/') . '/'}}assets/css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="{{url('/') . '/'}}dist/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="{{url('/') . '/'}}assets/css/styles.css" rel="stylesheet" type="text/css">
        <!-- <link href="{{url('/') . '/'}}assets/css/auto.css" rel="stylesheet" type="text/css"> -->
        <link href="{{url('/') . '/'}}assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="{{url('/') . '/'}}dist/css/work.css" rel="stylesheet" type="text/css">
        <link href="{{url('/') . '/'}}dist/css/angular-animation.css" rel="stylesheet" type="text/css">

         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <!-- // <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.js"></script> -->
         <!-- // <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script> -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

        <!-- // <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.2.3/jquery.js" type="text/javascript"></script> -->
        <script src ="{{url('/')}}/assets/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

        <script src="{{url('/')}}/dist/js/angular.js"></script>
        <script src="{{url('/')}}/dist/js/angular-route.js"></script>
        <script src="{{url('/')}}/dist/js/ngStorage.min.js"></script>
        <script src="{{url('/')}}/bower_components/angular-animate/angular-animate.js"></script>
        <!-- // <script src="{{url('/') . '/'}}dist/js/directives/angular.autocomplete.js"></script> -->
        <script src="{{url('/')}}/dist/js/app/util.js"></script>
        <script src="{{url('/')}}/dist/js/controllers/app.js"></script>
        <script src="{{url('/')}}/dist/js/controllers/resume.js"></script>
        <script src="{{url('/')}}/dist/js/controllers/work.js"></script>
        <script src="{{url('/')}}/dist/js/controllers/education.js"></script>
        <script src="{{url('/')}}/dist/js/controllers/skill.js"></script>
        <script src="{{url('/')}}/dist/js/controllers/save.js"></script>
        <script src="{{url('/')}}/dist/js/controllers/template.js"></script>
        <!-- // <script src="{{url('/') . '/'}}dist/js/ngAutocomplete.js"></script> -->
        @yield('style')
    </head>
    <body>



    
    @yield('content')
    

    
<script src ="{{url('/') . '/'}}assets/js/bootstrap.min.js"></script>
  
  
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        
        <script src ="{{url('/') . '/'}}assets/js/common.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function () {


            });


            $(window).resize(function () {

            });

            $(window).load(function () {



            });
        </script>
        <script>
            (function (d) {
                var config = {
                    kitId: 'fip8fmb',
                    scriptTimeout: 3000,
                    async: true
                },
                h = d.documentElement, t = setTimeout(function () {
                    h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
                }, config.scriptTimeout), tk = d.createElement("script"), f = false, s = d.getElementsByTagName("script")[0], a;
                h.className += " wf-loading";
                tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
                tk.async = true;
                tk.onload = tk.onreadystatechange = function () {
                    a = this.readyState;
                    if (f || a && a != "complete" && a != "loaded")
                        return;
                    f = true;
                    clearTimeout(t);
                    try {
                        Typekit.load(config)
                    } catch (e) {
                    }
                };
                s.parentNode.insertBefore(tk, s)
            })(document);
        </script>
         @yield('script')
</body>
</html>


      
      
  