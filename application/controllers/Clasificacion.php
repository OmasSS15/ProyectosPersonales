<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Clasificacion extends MY_Controller {

	// Retringir el acceso, excepto:
	protected $allowed_roles = [1];

	public function __construct(){	
		parent::__construct();
		$this->load->model('clasificacion_model');
		date_default_timezone_set('America/Merida');
	}

    public function index()
	{
		$mainData = [
			'title' => 'Catálogo de Clasificaciones',
			'content' => 'clasificacion/index',
			'clasificaciones' => $this->clasificacion_model->get_all_classification(),
 		];

		

		$this->load->view('templates/main', $mainData);

	}

    public function create()
	{
		$mainData = [
			'title' => 'Nueva Clasificación',
			'content' => 'clasificacion/create'
 		];

		$this->load->view('templates/main', $mainData);
		

	}

    public function store(){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$classificationData = [
			'name' => $this->input->post('clasificacion'),
			'status' => 1
		];

		$this->clasificacion_model->save_classification($classificationData);
		$this->session->set_flashdata('success', 'Registro subido con éxito.');
		redirect('Clasificacion');

		
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
			'title' => 'Modificar Datos de las Clasificaciones',
			'content' => 'clasificacion/edit',
			'clasificacion' => $this->clasificacion_model->get_classification_by_id($id)

 		];

		$this->load->view('templates/main', $mainData);
	}

	public function update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }


		$classificationData = [
			'name' => $this->input->post('clasificacion'),

		];

		$this->clasificacion_model->update_classification($id, $classificationData);
		$this->session->set_flashdata('success', 'Información actualizada con éxito');
		redirect('Clasificacion');
		
		
	}

	public function delete($id){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }
		
		$this->clasificacion_model->delete_classification($id);
		redirect('Clasificacion');
	}

}