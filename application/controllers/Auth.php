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
			redirect('home');
			return;
		}

		$mainData = [
			
			'title' => 'Iniciar Sesión',
			'input_value' => $this->session->flashdata('input_value')
 		];

		$this->load->view('auth/login', $mainData);
		

	}

	public function login(){

		// Login Activo
		if($this->session->userdata('logged_in')){
			// OTRA FORMA DE MOSTRAR UN MENSAJE DE ERROR Y PROTEGER LAS RUTAS
			//show_error('Ya iniciaste Sesión');
			redirect('home');

			return;
		}

		// Validaciones
		$this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email');
		$this->form_validation->set_rules('password', 'PASSWORD', 'required');
		
		$this->form_validation->set_message('required', 'El campo es obligatorio.');
		$this->form_validation->set_message('valid_email', 'No es un correo válido.');
		// $this->form_validation->set_message('matches', 'El campo %s no coincide con el campo %s.');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('form_errors', [
				'email'    => form_error('email'),
				'password' => form_error('password')
			]);
			$this->session->set_flashdata('input_value', [
				'email' => $this->input->post('email')
			]);
			redirect('auth');
			return;
		}

		// Verificar Usuario
		$user = $this->users_model->get_user_by_email($this->input->post('email'));

		if ($user->status == 0) {
            $this->session->set_flashdata('errors', 'Acceso Denegado');
            redirect('auth');

			return;
        }

		// SI EL USUARIO ES NULO Y LA CONTRASEÑA ENCRIPTADA ES IGUAL A LA ENVIADA EN EL LOGIN
		if($user != null && password_verify($this->input->post('password'), $user->password)){
			// LOGIN CORRECTO
			// set_userdata: SIRVE PARA GUARDAR LOS DATOS EN LA SESIÓN
			// DE MODO QUE PUEDAS ACCEDER A CUALQUIER PARTE DEL SISTEMA MIENTRAS LA SESIÓN ESTE ACTIVA.
			$this->session->set_userdata('user_id', $user->id);
			$this->session->set_userdata('email', $user->email);
			$this->session->set_userdata('idrol', $user->idrol);
			$this->session->set_userdata('idsucursal', $user->idsucursal);
			$this->session->set_userdata('status', $user->status);
			$this->session->set_userdata('logged_in', true);
			redirect('home');
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