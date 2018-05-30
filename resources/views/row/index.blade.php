<head>
	<!--<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />-->
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  	<script type="text/javascript" src="{{ url('js/jquery-1.4.2.min.js') }}"></script>
  	<script type="text/javascript" src="{{ url('js/jquery-ui-1.8.2.custom.min.js') }}"></script>
</head>
<form method="GET" action="{{ route('poncho') }}">
	{{csrf_field()}}
  <input type="text" id="criterio" name = 'criterio' class="form-control">
  <input class="btn btn-success" type="submit" value="Search">
</form>
<div id="php"></div>
<?php
$conexion = mysqli_connect("localhost","root","") or die("Error de host");
$base = mysqli_select_db($conexion,"chow") or die ("Error de base");
$sql = "select id,name,edad from post order by name asc";
$res = mysqli_query($conexion,$sql);
$nombres = array();
if(mysqli_num_rows($res) > 0)
  {
   array_push($nombres, "Sin informacion");
  }
else 
  {
  while($palabras = mysqli_fetch_array($res))
    {
    array_push(/*$nombres,$palabras["idc"].' '.*/$nombres,$palabras["id"]);
    }
}

?>
<script>
  $(function(){
    var autocompletar = new Array();
    <?php 
     for($y = 0;$y < count($nombres); $y++)
	 { ?>
       autocompletar.push('<?php echo $nombres[$y]; ?>');
     <?php } ?>
     $("#criterio").autocomplete({source: autocompletar});
  });
</script>