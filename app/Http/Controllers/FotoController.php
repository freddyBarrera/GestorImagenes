<?php namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\MostrarFotosRequest;
use GestorImagenes\Http\Requests\CrearFotoRequest;
use GestorImagenes\Http\Requests\ActualizarFotoRequest;
use Illuminate\Http\Request;

use GestorImagenes\Foto;
use GestorImagenes\Album;

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


	public function getActualizarFoto($id)
	{	
		$foto = Foto::find($id);
		return view('fotos.actualizar-foto', ['foto' => $foto]);
	}


	public function postActualizarFoto(ActualizarFotoRequest $request)
	{

		$foto = Foto::find($request->get('id'));
		$foto->nombre = $request->get('nombre');
		$foto->descripcion = $request->get('descripcion');

		if($request->hasFile('imagen'))
		{
			$imagen = $request->file('imagen');
			$ruta = '/img/';
			$nombre = sha1(Carbon::now()).'.'.$imagen->guessExtension();
			$imagen->move(getcwd().$ruta, $nombre);

			//Elimino la foto anterior
			$ruta_anterior = getcwd().$foto->ruta;
			if(file_exists($ruta_anterior))
			{
				unlink(realpath($ruta_anterior));
			}

			//Guardo la ruta nueva
			$foto->ruta = $ruta.$nombre;
		}

		$foto->save();

		return redirect('validado/fotos?id='.$foto->album_id)->with('editada', 'La foto ha sido editada');
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
