<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$mainData = [
			'title' => 'Inicio',
			'content' => 'home/index'
 		];

		$this->load->view('templates/main', $mainData);
		

	}

	
}