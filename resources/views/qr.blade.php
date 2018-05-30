<?php
$var = $folio;
?>

{!! QrCode::size(200)->generate('?var='.$var); !!}
<p>Scan me to return to the original page.</p>