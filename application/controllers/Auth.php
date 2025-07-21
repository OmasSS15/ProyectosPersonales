<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){	
		parent::__construct();
		$this->load->model('users_model');
		date_default_timezone_set('America/Merida');
	}

    public function index()
	{
		// userdata: IDENTIFICA SI LA SESSION YA ESTA ACTIVA
		if($this->session->userdata('logged_in')){

			//show_error('Ya iniciaste Sesión');
			redirect('archivero');
			return;
		}

		$mainData = [
			
			'title' => 'Iniciar Sesión',
 		];

		$this->load->view('auth/login', $mainData);
		

	}

	public function login(){

		if($this->session->userdata('logged_in')){
			// OTRA FORMA DE MOSTRAR UN MENSAJE DE ERROR Y PROTEGER LAS RUTAS
			//show_error('Ya iniciaste Sesión');
			redirect('archivero');

			return;
		}

		$user = $this->users_model->get_user_by_email($this->input->post('email'));

		// SI EL USUARIO ES NULO Y LA CONTRASEÑA ENCRIPTADA ES IGUAL A LA ENVIADA EN EL LOGIN
		if($user != null && password_verify($this->input->post('password'), $user->password)){
			// LOGIN CORRECTO
			// set_userdata: SIRVE PARA GUARDAR LOS DATOS EN LA SESIÓN
			// DE MODO QUE PUEDAS ACCEDER A CUALQUIER PARTE DEL SISTEMA MIENTRAS LA SESIÓN ESTE ACTIVA.
			$this->session->set_userdata('email', $user->email);
			$this->session->set_userdata('role', $user->role);
			$this->session->set_userdata('logged_in', true);
			redirect('archivero');
			return;
		} else{
			// LOGIN INCORRECTO
			$this->session->set_flashdata('errors', 'Credenciales Incorrectas.');
			redirect('auth');
			return;
		}

	}

	public function logout(){
		// sess_destroy: ELIMINA TODOS LOS DATOS QUE HAYA EN LA SESIÓN
		$this->session->sess_destroy();

		redirect('auth');
		return;
	}

}