<head>
	<title>DEVY JONES</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{ public_path('bootstrap.css') }}">
	<style type="text/css">
		#php{
			/*background-color: red;*/
			border-color: coral;
			border-style: none;
		}
	</style>
</head>
<div class="row" style=" /*background-color: blue;">
  <div class="col-xs-2" style=" /*background-color: #4d2600;*/ height: 30px; ">

  </div>
  <div class="col-xs-4" style=" /*background-color: #ff8c1a;*/ width: 350px;">
  	<p style="text-align: left; font-size: 8;">GONZALEZ GARDU;O PASCUAL</p>
  	<p style="font-size: 8;">CHICHIPICAS, NO. 90</p>
  	<p style="font-size: 8;">SAN PEDRO CHOCLULA, CP. 52757</p>
  	<P style="font-size: 8;">OCOYOACAC, MEXICO, MEXICO</P>
  	<P style="font-size: 8;">RFC: </P>
  	<P style="font-size: 8;">REGIMEN FISCAL: 621 - Incorporacion</P>
  </div>
  <div class="col-xs-3" style="  /*background-color: #cc6600;*/ text-align: center; font-size: 8; border-color: coral; border-style: solid; border-radius: 25px; ">
  	<p>Factura</p>
  	<p>670</p>
  	<p>fecha hora certificacion</p>	
  	<p><?= date('Y-m-d'); ?></p>
  	<p>fecha de Emicion</p>
  	<p><?= date('m-d'); ?></p>
  </div>
</div>
<br>
<div class="row" style=" /*background-color: red;*/">
	<div class="col-xs-4" style="/*background-color: pink;*/ font-size: 8; border-color: coral; border-style: solid; border-radius: 25px; ">
		<p>Receptor del Comprobante Fiscal</p>
		<p>DARTE DE MEXICO S DE RL DE CV</p>
	</div>
	<div class="col-xs-4" style=" /*background-color: purple;*/ width: 162px;"></div>
	<div class="col-xs-4" style=" /*background-color: yellow;*/ text-align: center; font-size: 8; border-color: coral; border-style: solid; border-radius: 25px; ">
		<p>Folio Fiscal</p>
		<p>{{ $folio }}</p>
		<p>Certificado Digital</p>
		<p>{{ $certificado }}</p>
		<p>Serie Certificado SAT</p>
		<p>{{ $var }}</p>
	</div>
</div>
<br>
<div class="row" style=" /*background-color: red;*/">
	<table border="1" width="30%" style="text-align: right;">
		<tr>
			<td>CAntidad</td>
			<td>Unidad</td>
			<td>Descripcion</td>
		</tr>
		@foreach ($post as $val)
		<tr>
			<td>{{ $val->id }}</td>
			<td>{{ $val->name }}</td>
			<td>{{ $val->edad }}</td>
		</tr>
		@endforeach
	</table>
</div>

<div class="row" style=" /*background-color: orange;*/ font-size: 8; text-align: right;">
	<div class="col-xs-4" style=" /*background-color: pink*/;">
		<p>Receptor del Comprobante Fiscal</p>
	</div>
	<div class="col-xs-4" style=" /*background-color: purple;*/ width: 162px;"></div>
	<div class="col-xs-4" style=" /*background-color: yellow;*/">
		<p>Folio Fiscal</p>
		<p>FGD4r563GHer35325-6575332-65fde3YYES</p>
	</div>
</div>
<div class="row" style=" /*background-color: black;*/ font-size: 8;">
	<p>Observacion</p>
</div>
<div  id="php" >
	              <?php
              echo "Sello: <br>";
                  $length = strlen($data);

                  $max = 99;

                  if ($length <= $max) {
                    echo $data;
                    return;
                  }

                  $m = 0;
                  echo "<font size='1'>";
                   for ($i=0; $i < ceil($length / $max) ; $i++) { 

                  //for ($i=0; $i < 3 ; $i++) { 
                    echo substr($data, $m, $max);
                    echo "<br>";
                    $m += $max;
                  }
                  echo "</font>";
                ?>
</div>

