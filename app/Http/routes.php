<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Post;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

//use DB;


Route::get('/', function () {
    return view('welcome');
});

Route::get('php',function(){

	$data = "Uojv6ETrqSUtTQD8y2sNlOtttnbCbS+jKLTdBUbvNU1TAxtLl3CTzXL5JvEKD14mcMgroOZN0v1s58G+RwPkdOKWNd7TUL2Yx9A/NWLrwQ1MMvKuW7/HNTJqiAnp03FIQBu9Vpun66QmEVxdm8NIBbVftgLeAaBwdCerCGwpKzTU6k/3HjoXcLoHaWc+vSpJ1OzK8F3ZmUBw56wmuRv4kSWnYcet0yyqva0mDgVjHVCF1x9kYYmNpWEifyudNV+po7Zj1vrrZcwz9xwUj+5XaA0bqwnghda0G5N/2ihVnO0umU3/41cmMJSr0Lz2cOxs/gW4EtsCO+RvqkrlrW8A3g==";

	$pdf = PDF::loadView('pdf',['id'=>$data]);
	$pdf->setPaper('a4', 'landscape')->setWarnings(false);
	return $pdf->stream();
	
});

Route::get('function',function(){

	$data = "Uojv6ETrqSUtTQD8y2sNlOtttnbCbS+jKLTdBUbvNU1TAxtLl3CTzXL5JvEKD14mcMgroOZN0v1s58G+RwPkdOKWNd7TUL2Yx9A/NWLrwQ1MMvKuW7/HNTJqiAnp03FIQBu9Vpun66QmEVxdm8NIBbVftgLeAaBwdCerCGwpKzTU6k/3HjoXcLoHaWc+vSpJ1OzK8F3ZmUBw56wmuRv4kSWnYcet0yyqva0mDgVjHVCF1x9kYYmNpWEifyudNV+po7Zj1vrrZcwz9xwUj+5XaA0bqwnghda0G5N/2ihVnO0umU3/41cmMJSr0Lz2cOxs/gW4EtsCO+RvqkrlrW8A3g==";

	$post = Post::all();

	$folio = '1BC3DA77-3E08-45E9-BFE4-948E4DB89FB1';

	$certificado = '00001000000403596116';

	$var = '00001000000403155917';

	$valor = 5;

	$php = PDF::loadView('pool',compact('var','valor','post','data','folio','certificado'));

	return $php->stream();

});

Route::get('qr',function(){

	$folio = 'Uojv6ETrqSUtTQD8y2sNlOtttnbCbS+jKLTdBUbvNU1TAxtLl3CTzXL5JvEKD14mcMgroOZN0v1s58G+RwPkdOKWNd7TUL2Yx9A/NWLrwQ1MMvKuW7/HNTJqiAnp03FIQBu9Vpun66QmEVxdm8NIBbVftgLeAaBwdCerCGwpKzTU6k/3HjoXcLoHaWc+vSpJ1OzK8F3ZmUBw56wmuRv4kSWnYcet0yyqva0mDgVjHVCF1x9kYYmNpWEifyudNV+po7Zj1vrrZcwz9xwUj+5XaA0bqwnghda0G5N/2ihVnO0umU3/41cmMJSr0Lz2cOxs/gW4EtsCO+RvqkrlrW8A3g==';

    return view('qr',compact('folio'));
});

Route::any('select', function(){
	$post = Post::all(); 
	return view('select',compact('post'));
})->name('select');

Route::any('opt','qrCode@select')->name('opt');

Route::any('any', function() { 
return view('material');
})->name('any');

Route::any('complet',function(){
	return view('row.index');
})->name('complet');

Route::any('poncho','qrCode@autocomplete')->name('poncho');

Route::any('query', function(){ 

	$title = Post::select('id','name');
	//dd($title);
	
	foreach ($title as $key => $value) {
		echo $value.'<hr>';
	}


})->name('query');

Route::any('login', function(){ 
	return view('login.login');
})->name('login');

Route::any('form','qrCode@validar')->name('form');

Route::any('bienvenido', function() {
	$var = Session::all();
	//dd($var); 
	return view('prueva.index',compact('var'));
})->name('bienvenido');

Route::any('ajax', function(){ 
	
	$post = Post::all();
	return view('table',compact('post'));
	
});

Route::any('library','qrCode@library');

Route::any('rar','qrCode@chow');



/*
Route::any('mosh', function() { 
	$var = new \App\Clases\DescargaMasivaCfdi;
	$print = $var->iniciarSesionCiecCaptcha();
});
*/		
