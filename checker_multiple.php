<html>
<head>
<title>Safe Browsing Checker</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/400adf9486.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
	$("#check_form").validate({
		rules: {
			urls: {
				required: true
			}
		},
		ignore: [],
		errorElement: "div",
		errorPlacement: function(error, element) {
			//$(element).after(error);
			$(element).parent('.form-group').after(error);
		},
		submitHandler: function(form) {
			$.ajax({
				url: "check_safe_browsing.php",
				type: 'POST',
				async: false,
				cache: false,
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert('Error Registering user');
				},
				data: $('#check_form').serialize(),
				success: function(data) {
					var matches = jQuery.parseJSON(data);
					var x=0;
					var notice = "";
					$.each(matches, function(index, values) {
						$.each(values, function(index, value) {
							var url = value['threat']['url'];
							console.log(url);
							
							notice += setNotice(url);
						});
						
						$('#alert-container').html(notice);
						
						x++;
					});
	
				}
			});
		}
	});
	
	$("#home_btn").click(function(){
		location.href = "index.php"; 
		//window.history.go(-1); 
		//return false;
	});
});

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 10000);

function setNotice(url){
	var notice = "<div class='alert alert-danger alert-dismissable fade in'>"+
				 "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+
				 "<p style='font-size: 18px;'>Current status</p>"+ 
				 "<p style='font-size: 24px;'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> This site is unsafe</p>"+
				 "<p>The site <b><i>"+url+"</i></b> contains harmful content, including pages that:</p>"+
				 "<ul>"+
				 "<li>Send visitors to harmful websites</li>"+
				 "<li>Try to trick visitors into sharing personal info or downloading software</li>"+
				 "</ul>"+
				 "</div>";
	return notice;
}
</script>

</head>
<body>
<div class="container" style="margin-top:10%;">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;"></i> <b>Check Safe Browsing</b></div>
				<div class="panel-body">
					<form id="check_form" method="POST">
					<input type="hidden" name="type" value="multiple">
					<div class="form-group">
						<label for="urls">Enter URL/s <small class="label label-danger">(Note: separate URLs using , or ;)</small></label>
						<textarea class="form-control" name="urls" rows="3"></textarea>
					</div>
					<button class="btn btn-default pull-right" type="submit"><i class="fa fa-check-circle"></i> Submit</button>
					
					</form>
				</div>
			</div>
			<div id="alert-container">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-offset-3 col-md-6 text-center">
			<button class="btn btn-default" id="home_btn"><i class="fa fa-home"></i> HOME</button>
		</div>
	</div>
</div>
</body>
</html>