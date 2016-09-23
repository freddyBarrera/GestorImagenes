<?php namespace GestorImagenes\Http\Controllers;

class AlbumController extends Controller {

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


	public function getIndex()
	{
		return "Mostrando albumes del usuario";
	}

	public function getCrearAlbum()
	{
		//return view('home');
		return "Formulario de crear Album";
	}


	public function postCrearAlbum()
	{
		//return view('home');
		return "Almacenando Album";
	}


	public function getActualizarAlbum()
	{
		//return view('home');
		return "Formulario de Actualizar Album";
	}


	public function postActualizarAlbum()
	{
		//return view('home');
		return "Actualizar Album";
	}


	public function getEliminarAlbum()
	{
		//return view('home');
		return "Formulario de eliminar Album";
	}


	public function postEliminarAlbum()
	{
		//return view('home');
		return "Eliminar Album";
	}


	public function missingMethod($parameters = array())
	{
		abort(404);
	}






}
