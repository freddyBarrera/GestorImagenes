<?php namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\MostrarFotosRequest;
use GestorImagenes\Http\Requests\CrearFotoRequest;
use Illuminate\Http\Request;

use GestorImagenes\Album;
use GestorImagenes\Foto;

use Carbon\Carbon;

class FotoController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}



	public function getIndex(MostrarFotosRequest $request)
	{
		$id = $request->get('id');
		$fotos = Album::find($id)->fotos;

		return view('fotos.mostrar', array('fotos'=>$fotos, 'id' => $id));
	}



	public function getCrearFoto(Request $request)
	{
		$id = $request->get('id');
		return view('fotos.crear-foto', ['id' => $id]);
	}


	public function postCrearFoto(CrearFotoRequest $request)
	{	
		$id = $request->get('id');
		$imagen = $request->file('imagen');
		$ruta = '/img/';
		$nombre = sha1(Carbon::now()).'.'.$imagen->guessExtension();
		$imagen->move(getcwd().$ruta, $nombre);

		Foto::create(
			[
				'nombre' => $request->get('nombre'),
				'descripcion' => $request->get('descripcion'),
				'ruta' => $ruta.$nombre,
				'album_id' => $request->get('id')
			]
		);

		return redirect('/validado/fotos?id='.$id)->with('creada', 'La foto ha sido subida');
	}


	public function getActualizarFoto()
	{
		//return view('home');
		return "Formulario de Actualizar foto";
	}


	public function postActualizarFoto()
	{
		//return view('home');
		return "Actualizar foto";
	}


	public function getEliminarFoto()
	{
		//return view('home');
		return "Formulario de eliminar foto";
	}


	public function postEliminarFoto()
	{
		//return view('home');
		return "Eliminar foto";
	}



	public function missingMethod($parameters = array())
	{
		abort(404);
	}






}
