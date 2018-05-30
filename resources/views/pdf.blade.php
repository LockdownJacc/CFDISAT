<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?php
	/*
	function multiexplode($delimiter, $data){
		$MakeReady = str_replace($delimiter, $delimiter[0], $data);
		$Return    = explode($delimiter[0], $MakeReady);
		return  $Return;
	}
	*/
	$data = $id;
	//$rar  = multiexplode(array("/"),$data);
	echo "<div class='col-xs-4' style='background-color: red;'>";
		echo $data;
	//foreach ($rar as $key => $value) {

		//echo $value,"<br>";

	//}

	echo "</div>";
	//$var1 = substr($id, -102);
?>

