<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales extends MY_Controller {

	// Retringir el acceso, excepto:
	protected $allowed_roles = [1];

	public function __construct(){	
		parent::__construct();
		$this->load->model('sucursal_model');
		$this->load->model('estado_model');
		date_default_timezone_set('America/Merida');
	}

    public function index()
	{
		$idestado = $this->input->get('estado_id');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');

		$mainData = [
			'title' => 'Catálogo de Sucursales',
			'content' => 'sucursal/index',
			'sucursales' => $this->sucursal_model->get_sucursal_filter($idestado, $start_date, $end_date),
			'estados' => $this->estado_model->get_estado_filter(),

			// Para mostra la opción seleccionada
			'idestado' => $idestado,
			'start_date' => $start_date,
    		'end_date' => $end_date
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
			'title' => 'Detalles de la Sucursal',
			'content' => 'sucursal/show',
			'sucursal' => $this->sucursal_model->get_sucursal_by_id($id)
 		];

		$this->load->view('templates/main', $mainData);
	}

    public function show_update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$sucursalData = [
			'status' => $this->input->post('status')

		];

		$this->sucursal_model->update_sucursal($id, $sucursalData);
		$this->session->set_flashdata('success', 'Cambios guardados con éxito');
		redirect('sucursales');
		
		
	}

    public function create()
	{
		$mainData = [
			'title' => 'Nueva Sucursal',
			'content' => 'sucursal/create',
            'estados' => $this->estado_model->get_estado_filter(),
 		];

		$this->load->view('templates/main', $mainData);
		

	}

    public function store(){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$sucursalData = [
			'sucursal' => $this->input->post('name'),
			'idestado' => $this->input->post('estado_id'),
			'address' => $this->input->post('address'),
            'status' => 1
		];

		$this->sucursal_model->save_sucursal($sucursalData);
		$this->session->set_flashdata('success', 'Registro subido con éxito.');
		redirect('sucursales');

		
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
			'title' => 'Modificar Datos de la Sucursal',
			'content' => 'sucursal/edit',
			'sucursal' => $this->sucursal_model->get_sucursal_by_id($id),
			'estados' => $this->estado_model->get_estado_filter()

 		];

		$this->load->view('templates/main', $mainData);
	}

	public function update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }


		$sucursalData = [
			'sucursal' => $this->input->post('name'),
			'idestado' => $this->input->post('estado_id'),
			'address' => $this->input->post('address')

		];

		$this->sucursal_model->update_sucursal($id, $sucursalData);
		$this->session->set_flashdata('success', 'Información actualizada con éxito');
		redirect('sucursales');
		
		
	}

	public function delete($id){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }
		
		$this->sucursal_model->delete_sucursal($id);
		redirect('sucursales');
	}

}