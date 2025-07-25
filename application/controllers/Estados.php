<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Estados extends MY_Controller {

	// Retringir el acceso, excepto:
	protected $allowed_roles = [1];
	
	public function __construct(){	
		parent::__construct();
		$this->load->model('estado_model');
		date_default_timezone_set('America/Merida');
	}

    public function index()
	{
		$mainData = [
			'title' => 'Catálogo de Estados',
			'content' => 'estado/index',
			'estados' => $this->estado_model->get_all_estado(),
 		];

		

		$this->load->view('templates/main', $mainData);

	}

    public function create()
	{
		$mainData = [
			'title' => 'Nuevo Lugar',
			'content' => 'estado/create'
 		];

		$this->load->view('templates/main', $mainData);
		

	}

    public function store(){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$estadoData = [
			'estado' => $this->input->post('name'),
			'abrev' => $this->input->post('abrev'),
            'status' => 1
		];

		$this->estado_model->save_estado($estadoData);
		$this->session->set_flashdata('success', 'Registro subido con éxito.');
		redirect('estados');

		
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
			'title' => 'Modificar Datos del Estado',
			'content' => 'estado/edit',
			'estado' => $this->estado_model->get_estado_by_id($id)

 		];

		$this->load->view('templates/main', $mainData);
	}

	public function update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }


		$estadoData = [
			'estado' => $this->input->post('name'),
			'abrev' => $this->input->post('abrev'),
            'status' => $this->input->post('status')

		];

		$this->estado_model->update_estado($id, $estadoData);
		$this->session->set_flashdata('success', 'Información actualizada con éxito');
		redirect('estados');
		
		
	}

	public function delete($id){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }
		
		$this->estado_model->delete_estado($id);
		redirect('estados');
	}

}