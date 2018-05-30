<!DOCTYPE html>
<html>
<head>
	<title></title>
		<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">

</head>
<body>


<div class="container">
	<div class="card text-center" style="width: 22rem;">
	    <div class="card-header success-color white-text">
	        Featured
	    </div>
	    <div class="card-body">
	       
	        <button class="btn aqua-gradient btn-rounded" id="boton">Aqua</button>
	        <div id="php"></div>
	    </div>
	    <div class="card-footer text-muted success-color white-text">
	        <p class="mb-0"></p>
	    </div>
	</div>
</div>

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>
<script type="text/javascript">
	$('#boton').click(function(){
		var x = prompt("Valor 1:");
		var y = prompt("Valor 2:");
		var resultado =parseInt(x) + parseInt(y);
		$('.mb-0').append(resultado);
	});
</script>
</body>
</html>
