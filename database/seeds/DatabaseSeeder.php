<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


use GestorImagenes\Album;
use GestorImagenes\Foto;
use GestorImagenes\Usuario;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{	

		//No hacer verificacion de claves foraneas
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
	
		//Elimino los registros antes de llenar
		Foto::truncate();
		Album::truncate();
		Usuario::truncate();

		$this->call('UsuariosSeeder');
		$this->call('AlbumesSeeder');
		$this->call('FotosSeeder');
	}

}
