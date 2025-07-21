<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct(){	
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('rol_model');
		$this->load->model('sucursal_model');
		date_default_timezone_set('America/Merida');
	}

    public function index()
	{
		$idsucursal = $this->input->get('sucursal_id');
		$idrol = $this->input->get('rol_id');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');

		$mainData = [
			'title' => 'Catálogo de Usuarios',
			'content' => 'users/index',
			'users' => $this->users_model->get_users_filters($idsucursal, $idrol, $start_date, $end_date),
			'sucursales' => $this->sucursal_model->get_all_sucursal(),
			'roles' => $this->rol_model->get_all_rol(),

			// Para mostra la opción seleccionada
			'idsucursal' => $idsucursal,
			'idrol' => $idrol,
			'start_date' => $start_date,
    		'end_date' => $end_date,
 		];

		

		$this->load->view('templates/main', $mainData);

	}

    public function show($id){
		// ES PARA NO MOSTRAR NADA CUANDO EL ID NO EXISTA
		// $product = $this->product_model->get_product_by_id($id);
		// if($product == null){
		// 	show_404();
		// }

		$mainData = [
			'title' => 'Detalles del Usuario',
			'content' => 'users/show',
			'user' => $this->users_model->get_user_by_id($id)
 		];

		$this->load->view('templates/main', $mainData);
	}

    public function show_update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$userData = [
			'status' => $this->input->post('status')

		];

		$this->users_model->update_user($id, $userData);
		$this->session->set_flashdata('success', 'Cambios guardados con éxito');
		redirect('users');
		
		
	}

    public function register()
	{
		$mainData = [
			'title' => 'Nuevo Usuario',
			'content' => 'users/register',
            'roles' => $this->rol_model->get_all_rol(),
			'sucursales' => $this->sucursal_model->get_all_sucursal()
 		];

		$this->load->view('templates/main', $mainData);
		

	}

    public function store(){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$userData = [
			'name' => $this->input->post('name'),
			'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'idrol' => $this->input->post('rol_id'),
			'idsucursal' => $this->input->post('sucursal_id'),
			'status' => 1,

		];

		$this->users_model->save_user($userData);
		$this->session->set_flashdata('success', 'Registro subido con éxito.');
		redirect('users');

		
	}
    
    public function edit($id) {
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		// $archivero = $this->archivero_model->get_file_by_id($id);
		// if($archivero == null){
		// 	show_404();
		// }

		$mainData = [
			'title' => 'Modificar Datos del Usuario',
			'content' => 'users/edit',
			'user' => $this->users_model->get_user_by_id($id),
			'roles' => $this->rol_model->get_all_rol(),
			'sucursales' => $this->sucursal_model->get_all_sucursal()
 		];

		$this->load->view('templates/main', $mainData);
	}

	public function update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }


		$userData = [
			'name' => $this->input->post('name'),
			'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
			'idrol' => $this->input->post('rol_id'),
			'idsucursal' => $this->input->post('sucursal_id'),

		];

		// Verificar si se escribió una nueva contraseña
		$password = $this->input->post('password');
		if (!empty($password)) {
			$userData['password'] = password_hash($password, PASSWORD_DEFAULT);
		}

		$this->users_model->update_user($id, $userData);
		$this->session->set_flashdata('success', 'Información actualizada con éxito');
		redirect('users');
		
		
	}

	public function delete($id){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }
		
		$this->users_model->delete_user($id);
		redirect('users');
	}

}