<?php namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\MostrarFotosRequest;

use GestorImagenes\Album;
use GestorImagenes\Foto;

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

		return view('fotos.mostrar', array('fotos'=>$fotos));
	}



	public function getCrearFoto()
	{
		//return view('home');
		return "Formulario de crear foto";
	}


	public function postCrearFoto()
	{
		//return view('home');
		return "Almacenando foto";
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
