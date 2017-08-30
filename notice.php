
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Check Safe Browsing</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		<script src="https://use.fontawesome.com/400adf9486.js"></script>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #CE3426;
                color: #fff;
                font-family: 'Raleway', sans-serif;
                height: 100vh;
                margin: 0;

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
				font-size: 16px;
				font-weight: bold;
            }

            .title {
                font-size: 36px;
            }

            .btn{
				background-color: #CE3426;
				border-radius: 0px;
				border-color: #fff;
				font-weight: bold;
			}

         
        </style>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#back_btn").click(function(){
					window.history.go(-1); 
					return false;
				});
			});
		</script>
    </head>
    <body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="flex-center position-ref full-height">            
						<div class="content">
						  
							 <i class='fa fa-times-circle fa-5x' aria-hidden='true'></i>
							 <p class="title"> This site is unsafe</p>
							 <p>The site <b><i><?=$_GET['url']?></i></b> contains harmful content, including pages that:</p>
							 <ul>
								 <li>Send visitors to harmful websites</li>
								 <li>Try to trick visitors into sharing personal info or downloading software</li>
							 </ul>
							 <p style="margin-top: 50px;">
								<button class="btn btn-danger pull-right" id="back_btn"> BACK TO SAFETY</button>
							 </p>
						</div>
				        
					</div>
					
				</div>
			</div>
        </div>
		
    </body>
</html>
