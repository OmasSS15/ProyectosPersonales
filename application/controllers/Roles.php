<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller {

	// Retringir el acceso, excepto:
	protected $allowed_roles = [1];
	
	public function __construct(){	
		parent::__construct();
		$this->load->model('rol_model');
		date_default_timezone_set('America/Merida');
	}

    public function index()
	{
		$mainData = [
			'title' => 'Catálogo de Roles',
			'content' => 'rol/index',
			'roles' => $this->rol_model->get_all_rol(),
 		];

		

		$this->load->view('templates/main', $mainData);

	}

    public function create()
	{
		$mainData = [
			'title' => 'Nuevo Rol',
			'content' => 'rol/create'
 		];

		$this->load->view('templates/main', $mainData);
		

	}

    public function store(){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$rolData = [
			'rol' => $this->input->post('rol'),
		];

		$this->rol_model->save_rol($rolData);
		$this->session->set_flashdata('success', 'Registro subido con éxito.');
		redirect('roles');

		
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
			'title' => 'Modificar Datos del Rol',
			'content' => 'rol/edit',
			'rol' => $this->rol_model->get_rol_by_id($id)

 		];

		$this->load->view('templates/main', $mainData);
	}

	public function update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }


		$rolData = [
			'rol' => $this->input->post('rol'),

		];

		$this->rol_model->update_rol($id, $rolData);
		$this->session->set_flashdata('success', 'Información actualizada con éxito');
		redirect('roles');
		
		
	}

	public function delete($id){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }
		
		$this->rol_model->delete_rol($id);
		redirect('roles');
	}

}