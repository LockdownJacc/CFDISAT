<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Session;
use DOMDocument;

use \App\Clases\BusquedaRecibidos;
use \App\Clases\DescargaMasivaCfdi;

class qrCode extends Controller
{
    //

    

        public function return($data){

        	$var = $data;
        	print_r($var);
        	
        }

        public function select(Request $request){
        	//$var = $request->all();
            $new = new Post;
            $new->name = $request->opt;
            $new->edad = $request->opt2;
            $new->save();
            return redirect()->route('select');
        	//dd($var);
        }

        public function autocomplete(){

            $term = Input::get('q');

            $results = array();

            $queries = DB::table('post')
                    ->where('name', 'LIKE', '%'.$term.'%')
                    ->orWhere('id', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

            
            foreach ($queries as $query)
            {
                $results[] = [ 'id' => $query->id, 'value' => $query->name ];
            }
            return Response::json($results);
        }

        public function validar(Request $request){
            $usuario = $request->input('usuario');
            $pass    = $request->input('pass');

            $consulta = DB::table('usuarios')
                                    ->select('usuarios.idu','usuarios.usuario','usuarios.contraseña')
                                    ->where('usuario','=',$usuario)
                                    ->where('contraseña','=',$pass)
                                    ->where('usuarios.activo','=','SI')
                                    ->get();
            if(count($consulta)==0){
                $mensaje = Session::flash('error','El usuario no existe o la contraseña no es correcta');
                return redirect()->route('login',compact('mensaje'));
            }else{
                Session::put('sessionid',$consulta[0]->idu);
                Session::put('session_usuario',$consulta[0]->usuario);
                
                return redirect()->route('bienvenido');
            }                      
        }

        public function library(){
           
            $var = new \App\Clases\DescargaMasivaCfdi;
            return view('php.index',compact('var'));
        }

        public function chow(Request $request){

          require dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'DescargaMasivaCfdi.php';

          require dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'UtilCertificado.php';

          $config = require dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'config.php';

                   // Preparar variables
          $rutaDescarga = $config['rutaDescarga'];
          $maxDescargasSimultaneas = $config['maxDescargasSimultaneas'];

          // Instanciar clase principal
          $descargaCfdi = new DescargaMasivaCfdi();

          function json_response($data, $success=true) {
            header('Cache-Control: no-transform,public,max-age=300,s-maxage=900');
            header('Content-Type: application/json');
            return json_encode(array(
              'success' => $success,
              'data' => $data
            ));
          }

          if(!empty($_POST)) {

            if(!empty($_POST['sesion'])) {
              $descargaCfdi->restaurarSesion($_POST['sesion']);
            }

            $accion = empty($_POST['accion']) ? null : $_POST['accion'];
            
            if($accion == 'login_ciec') {
              if(!empty($_POST['rfc']) && !empty($_POST['pwd'])) {

                // iniciar sesion en el SAT
                $ok = $descargaCfdi->iniciarSesionCiec($_POST['rfc'],$_POST['pwd']);
                if($ok) {
                  echo json_response(array(
                    'mensaje' => 'Se ha iniciado la sesión',
                    'sesion' => $descargaCfdi->obtenerSesion()
                  ));
                }else{
                  echo json_response(array(
                    'mensaje' => 'Ha ocurrido un error al iniciar sesión. Intente nuevamente',
                  ));
                }
              }else{
                echo json_response(array(
                  'mensaje' => 'Proporcione todos los datos',
                ));
              }
            }elseif($accion == 'login_ciecc') {
              if(!empty($_POST['rfc']) && !empty($_POST['pwd']) && !empty($_POST['captcha'])) {

                // iniciar sesion en el SAT
                $ok = $descargaCfdi->iniciarSesionCiecCaptcha($_POST['rfc'],$_POST['pwd'],$_POST['captcha']);
                if($ok) {
                  echo json_response(array(
                    'mensaje' => 'Se ha iniciado la sesión',
                    'sesion' => $descargaCfdi->obtenerSesion()
                  ));
                }else{
                  echo json_response(array(
                    'mensaje' => 'Ha ocurrido un error al iniciar sesión. Intente nuevamente',
                  ));
                }
              }else{
                echo json_response(array(
                  'mensaje' => 'Proporcione todos los datos',
                ));
              }
            }elseif($accion == 'login_fiel') {
              if(!empty($_FILES['cer']) && !empty($_FILES['key']) && !empty($_POST['pwd'])) {

                // preparar certificado para inicio de sesion
                $certificado = new UtilCertificado();
                $ok = $certificado->loadFiles(
                  $_FILES['cer']['tmp_name'],
                  $_FILES['key']['tmp_name'],
                  $_POST['pwd']
                );

                if($ok) {
                  // iniciar sesion en el SAT
                  $ok = $descargaCfdi->iniciarSesionFiel($certificado);
                  if($ok) {
                    echo json_response(array(
                      'mensaje' => 'Se ha iniciado la sesión',
                      'sesion' => $descargaCfdi->obtenerSesion()
                    ));
                  }else{
                    echo json_response(array(
                      'mensaje' => 'Ha ocurrido un error al iniciar sesión. Intente nuevamente',
                    ));
                  }
                }else{
                  echo json_response(array(
                    'mensaje' => 'Verifique que los archivos corresponden con la contraseña e intente nuevamente',
                  ));
                }
              }else{
                echo json_response(array(
                  'mensaje' => 'Proporcione todos los datos',
                ));
              }
            }elseif($accion == 'buscar-recibidos') {
              $filtros = new BusquedaRecibidos();
              $filtros->establecerFecha($_POST['anio'], $_POST['mes'], $_POST['dia']);

              $xmlInfoArr = $descargaCfdi->buscar($filtros);
              
              if($xmlInfoArr){
                $items = array();
                foreach ($xmlInfoArr as $xmlInfo) {
                  $items[] = (array)$xmlInfo;
                }
                echo json_response(array(
                  'items' => $items,
                  // 'sesion' => $descargaCfdi->obtenerSesion()
                ));
              }else{
                echo json_response(array(
                  'mensaje' => 'No se han encontrado CFDIs'
                ));          
              }
              
            }elseif($accion == 'buscar-emitidos') {
              $filtros = new BusquedaEmitidos();
              $filtros->establecerFechaInicial($_POST['anio_i'], $_POST['mes_i'], $_POST['dia_i']);
              $filtros->establecerFechaFinal($_POST['anio_f'], $_POST['mes_f'], $_POST['dia_f']);

              $xmlInfoArr = $descargaCfdi->buscar($filtros);
              if($xmlInfoArr){
                $items = array();
                foreach ($xmlInfoArr as $xmlInfo) {
                  $items[] = (array)$xmlInfo;
                }
                echo json_response(array(
                  'items' => $items,
                  // 'sesion' => $descargaCfdi->obtenerSesion()
                ));
              }else{
                echo json_response(array(
                  'mensaje' => 'No se han encontrado CFDIs'
                ));          
              }
            }elseif($accion == 'descargar-recibidos' || $accion == 'descargar-emitidos') {
              $descarga = new DescargaAsincrona($maxDescargasSimultaneas);

              if(!empty($_POST['xml'])) {
                foreach ($_POST['xml'] as $folioFiscal => $url) {
                  // $descargaCfdi->guardarXml($url, $ruta, $folioFiscal);
                  $descarga->agregarXml($url, $rutaDescarga, $folioFiscal);
                }
              }
              if(!empty($_POST['acuse'])) {
                foreach ($_POST['acuse'] as $folioFiscal => $url) {
                  // $descargaCfdi->guardarAcuse($url, $ruta, $folioFiscal);
                  $descarga->agregarAcuse($url, $rutaDescarga, $folioFiscal);
                }
              }

              $descarga->procesar();

              $str = 'Descargados: '.$descarga->totalDescargados().'.'
                . ' Errores: '.$descarga->totalErrores().'.'
                . ' Duración: '.$descarga->segundosTranscurridos().' segundos.'
                ;
              echo json_response(array(
                'mensaje' => $str
              ));
            }
          }

        }
}
