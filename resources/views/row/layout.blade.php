<!DOCTYPE html>
<html>
<head>
	<title>LARAVEL</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		p{
			color: red;
			position: absolute;
			font-family: all;
		}
	</style>
</head>
<body>
	<div class="container">
		@yield('content')
	</div>
	<script type="text/javascript">
			$(document).ready(function(){

				//alert("Value: " + );
				console.log($("#test").val());

				
			});
				/*
				$.ajax({
					url: '{{ url('ajax') }}', 
					success: function(result){
			            $("#div1").html(result);
			        }
		    	});
		    	*/
	</script>
</body>
</html>