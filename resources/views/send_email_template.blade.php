<html>
<head>
    <meta charset="UTF-8">
    <title>Resume Builder</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    
      </head>
 <body>
	


	<div class="container">
		<div class="row">
                    
			<div class="col-lg-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12" style="margin-top: 12px;">
                            
				<section class="panel" style="padding: 36px">
                                    
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            @if(isset($data['header']))
                                            <header class="panel-heading" style="text-align: left">
                                                {{isset($data['header']) ? $data['header'] : ""}}
                                            </header>
                                            @endif
                                        </div>
                                    </div>
					
					
					<p style="margin-top: 28px;margin-bottom: 26px"><strong>{{$data['call']}}</strong></p>
					
					

                    
                        <p><?php echo $data['content']; ?> </p>
                    

                    <div style="margin-top: 60px;"></div>		
					@foreach($data['signature'] as $sig)
                        <p><?php echo $sig; ?> </p>
                    @endforeach
                            
                    
                    </section>
			</div>
		</div>
            
            
            
            
	</div>	    	
    	
 </body>
</html>             



