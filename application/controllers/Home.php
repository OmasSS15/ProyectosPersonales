<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		echo "ID de usuario en sesión: " . $this->session->userdata('user_id');
		echo "Rol de usuario en sesión: " . $this->session->userdata('idrol');
		
		$mainData = [
			'title' => 'Inicio',
			'content' => 'home/index'
 		];

		$this->load->view('templates/main', $mainData);
		

	}

	
}