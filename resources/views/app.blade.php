<!DOCTYPE html>
<html lang="en" ng-app="myapp">
    <head>


          <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <any ng-controller="PageTitleController">
        <title>@yield('title') </title>
        </any>
        <!-- fevicon -->
        <link href="{{url('/') . '/'}}assets/images/fevicon.png" rel="shortcut icon"/>
        <link href="{{url('/') . '/'}}assets/images/fevicon.png" rel="apple-touch-icon"/>
        <link href="{{url('/') . '/'}}assets/images/fevicon.png" rel="shortcut icon" type="{{url('/') . '/'}}assets/images/ico"/>
        <link href="{{url('/') . '/'}}assets/images/fevicon.png" rel="icon" type="image/ico"/>
        <!-- css -->
        <link href="{{url('/') . '/'}}assets/css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="{{url('/') . '/'}}dist/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="{{url('/') . '/'}}assets/css/styles.css?111" rel="stylesheet" type="text/css">
        <!-- <link href="{{url('/') . '/'}}assets/css/auto.css" rel="stylesheet" type="text/css"> -->
        <link href="{{url('/') . '/'}}assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="{{url('/') . '/'}}dist/css/work.css" rel="stylesheet" type="text/css">
        <link href="{{url('/') . '/'}}dist/css/angular-animation.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Open+Sans|Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" rel="stylesheet"> 
        
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <!-- // <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.js"></script> -->
         <!-- // <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script> -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet"> 
        <script>
            var app_url = "{{url('/')}}/";
            var _preview_template = 5;
            
        </script>
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2023709-1', 'auto');
  ga('send', 'pageview');

</script>
        <!-- // <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.2.3/jquery.js" type="text/javascript"></script> -->
        <script src ="{{url('/')}}/assets/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

        <script src="{{url('/')}}/dist/js/angular.js"></script>
        <script src="{{url('/')}}/dist/js/angular-route.js"></script>
        <script src="{{url('/')}}/dist/js/ngStorage.min.js"></script>
  
        <script src="{{url('/')}}/bower_components/angular-animate/angular-animate.js"></script>
        <script src="{{url('/')}}/bower_components/angular-messages/angular-messages.js"></script>
        <script src="{{url('/')}}/bower_components/ng-media-query/ng-media-query.js"></script>
        <script src="{{url('/')}}/bower_components/angular-sanitize/angular-sanitize.js"></script>

        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.1.js"></script>
        <!-- // <script src="{{url('/') . '/'}}dist/js/directives/angular.autocomplete.js"></script> -->

         <script src="{{url('/')}}/dist/js/app/util.js?6544"></script>
         <script src="{{url('/')}}/dist/js/app/app.js?44654"></script>
        <script src="{{url('/')}}/dist/js/controllers/resume.js?44456243"></script>
        <script src="{{url('/')}}/dist/js/controllers/work.js?465445"></script>
        <script src="{{url('/')}}/dist/js/controllers/education.js?45644"></script>
        <script src="{{url('/')}}/dist/js/controllers/skill.js?34624"></script>
        <script src="{{url('/')}}/dist/js/controllers/save.js?344655"></script>
        <script src="{{url('/')}}/dist/js/controllers/template.js?4343562"></script>


        <style>

#template1 .html {
  display:  block;
  text-align: justify !important;
}


        /*validation*/
        div.help-block {

            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;


            /*warning*/
            background-color: #fcf8e3;
            border-color: #faebcc;
            color: #8a6d3b;

            /*danger*//*
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
            */

        }

        div.help-block:empty {
            display: none;
        }

        .inlineForm input[aria-invalid="true"], .inlineForm textarea[aria-invalid="true"]{
           border:2px solid #faebcc;
       }

       .inlineForm input[aria-invalid="true"]:focus {
        outline: 2px solid #faebcc ;
       }




       /*home page plance alignment fix*/
       .home-page-signup-plans-wrapper .left, .home-page-signup-plans-wrapper .right {
            margin-top: 0;
        }

        /*footer fix*/
        html, body {
            height: 100%;

        }

        .full_page_wrap {

           min-height: 100%;
           padding-bottom: 102px;
       }

       .inner-footer {
          margin-top: -102px;
          height: 102px;
      }
.rb-navgation .navbar-nav li a {
    font-weight: 500;
    font-size: 16px;
    color: #8495a3;
    padding: 11px 16px;
    font-family: "museo-sans", sans-serif;
}
      /**/

      label, a.next-button, a.back-button {
        cursor: pointer;
      }

      a.next-button:hover, a.back-button:hover {
        box-shadow: 0px 0px 18px 14px rgba(100,100,100, .3) inset;
      }

       a.next-button, a.back-button {
        /*transition: box-shadow 300 ease-in-out;*/
        transition: all 300 ease-in-out;
      }

      a.add-degree:hover , a.skill-add-button:hover, a.add-button:hover {
        background: rgba(100,100,100,.1);
      }

      .hover-shadow , button ,.next-button, .back-button{
        transition: box-shadow 150ms ease-in-out;
      }
      .hover-shadow:hover, button:hover, .next-button:hover, .back-button:hover {
        box-shadow: 0 0 12px 0px #888 !important;
      }

      .col-xs-6.clear-fix {
        clear: both;
      }
       </style>


        <!-- // <script src="{{url('/') . '/'}}dist/js/ngAutocomplete.js"></script> -->
        @yield('style')
    </head>
    <body data-breakpoints>



    
    @yield('content')
    

    
<!-- <script src ="{{url('/') . '/'}}assets/js/bootstrap.min.js"></script> -->
  
  
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


      
      
  