<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Archivero extends MY_Controller {

	public function __construct(){	
		parent::__construct();
		$this->load->model('archivero_model');
		$this->load->model('clasificacion_model');
		$this->load->model('sucursal_model');
		date_default_timezone_set('America/Merida');
	}

	public function index()
	{
		//Filtros
		$idclassification = $this->input->get('clasificacion_id'); // Por Clasificacion
		$idsucursal = $this->input->get('sucursal_id'); // Por Sucursal (Solo el Admin)
		$start_date = $this->input->get('start_date'); // Fecha de inicio
		$end_date = $this->input->get('end_date'); // Ultima fecha

		// Sucursal con respecto al Usuario
		$idrol_user = $this->session->userdata('idrol');
    	$idsucursal_user = $this->session->userdata('idsucursal');

		// DATATABLE JS ID
		if($idrol_user == 1){
			$datatable = 'datatable_files';
		} else {
			$datatable = 'datatable_files2';
		};

		$mainData = [
			'title' => 'Archivero',
			'content' => 'archivero/index',
			// 'files' => $this->archivero_model->get_all_files(),
			'files' => $this->archivero_model->get_files_filters($idclassification, $idsucursal, $start_date, $end_date, $idrol_user, $idsucursal_user),
			'clasificaciones' => $this->clasificacion_model->get_classification_filter(), //Filtro
			'sucursales' => $this->sucursal_model->get_all_sucursal(), //Filtro
			'datatable' => $datatable,

			// Para mostra la opción seleccionada
			'idclassification' => $idclassification,
			'idsucursal' => $idsucursal,
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
			'title' => 'Detalles del Documento',
			'content' => 'archivero/show',
			'file' => $this->archivero_model->get_file_by_id_filter($id)
 		];

		$this->load->view('templates/main', $mainData);
	}

	public function show_update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$fileData = [
			'commentary' => $this->input->post('comment'),
			'status' => $this->input->post('status')

		];

		$this->archivero_model->update_file($id, $fileData);
		$this->session->set_flashdata('success', 'Cambios guardados con éxito');
		redirect('archivero');
		
		
	}


	public function upload()
	{
		$mainData = [
			'title' => 'Nuevo Archivo',
			'content' => 'archivero/upload',
			'clasificaciones' => $this->clasificacion_model->get_classification_filter(),
			'sucursales' => $this->sucursal_model->get_all_sucursal()
 		];

		$this->load->view('templates/main', $mainData);
		

	}

	public function store(){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		// $config['upload_path'] = './uploads/'; // ruta para guardar los archivos
		// $config['allowed_types'] = 'pdf|txt|xlsx'; // archivos permitidos
		// $config['max_size'] = 51200; // tamaño maximo del archivo
		

		$new_name = date('YmdHis'); // Cacmbia el nombre por la fecha y hora
		$user_id = $this->session->userdata('user_id'); //id del usuario
		$idsucursal = $this->session->userdata('idsucursal'); //id de la sucursal del usuario

		$config = [
			'upload_path' => './uploads/', // ruta para guardar los archivos
			'allowed_types' => 'pdf|txt|xlsx', // archivos permitidos
			'max_size' => 51200, // tamaño maximo del archivo
			'file_name' => $new_name 
		];

		$this->load->library('upload', $config); // libreria para subir archivos


		if (!$this->upload->do_upload('file')) { // mostrar error si el archivo es false
			// $error = $this->upload->display_errors();
			// $this->upload->display_errors();

			$this->session->set_flashdata('errors', 'Ocurrió un error al subir el archivo. Verifica que el archivo cumpla con todos los requisitos.');

			// $this->session->set_flashdata('errors', $error);
			redirect('archivero/upload');

			return;
		}
		else {

			$data = $this->upload->data(); // guardar datos del archivo

			$fileData = [
				'name' => $this->input->post('name'),
				'file' => $data['file_name'],
				'iduser' => $user_id,
				'idclassification' => $this->input->post('clasificacion_id'),
				// 'idsucursal' => $this->input->post('sucursal_id'),
				'idsucursal' => $idsucursal,
				'description' => $this->input->post('description'),
				'status' => 2,

			];

			$this->archivero_model->save_file($fileData);
			$this->session->set_flashdata('success', 'Archivo subido con éxito.');
			redirect('archivero');

		}
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
			'title' => 'Modificar Datos del Documento',
			'content' => 'archivero/edit',
			'file' => $this->archivero_model->get_file_by_id($id),
			'clasificaciones' => $this->clasificacion_model->get_classification_filter(),
			'sucursales' => $this->sucursal_model->get_all_sucursal()
 		];

		$this->load->view('templates/main', $mainData);
	}

	public function update($id){
		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		$new_name = date('YmdHis');

		$config = [
			'upload_path' => './uploads/', // ruta para guardar los archivos
			'allowed_types' => 'pdf|txt|xlsx', // archivos permitidos
			'max_size' => 51200,
			'file_name' => $new_name 
		];

		$this->load->library('upload', $config); // libreria para subir archivos

		$data = []; // Inicializamos por si no se sube archivo

		$fileData = [
			'name' => $this->input->post('name'),
			'idclassification' => $this->input->post('clasificacion_id'),
			'description' => $this->input->post('description'),
			// 'status' => $this->input->post('status')

		];

		// Verifica que no haya un archivo
		if (!empty($_FILES['file']['name'])) {
			if ($this->upload->do_upload('file')) {
				// Guarda y sube el nuevo archivo
				$data = $this->upload->data();
				$fileData['file'] = $data['file_name'];

				// Elimina el archivo anterior
				$oldFile = $this->archivero_model->get_file_by_id($id);
				if ($oldFile && file_exists('./uploads/' . $oldFile->file)) {
					unlink('./uploads/' . $oldFile->file);
				}
			} else {
				$this->session->set_flashdata('errors', 'Ocurrió un error al subir el archivo. Verifica que el archivo cumpla con todos los requisitos.');
				redirect('archivero/edit/' . $id);
				return;
			}
		}

		// if (!empty($data['file_name'])) {
		// 	$fileData['file'] = $data['file_name'];
		// }

		$this->archivero_model->update_file($id, $fileData);
		$this->session->set_flashdata('success', 'Información actualizada con éxito');
		redirect('archivero');
		
		
	}

	public function delete($id){

		// SI EL ROL NO ES ADMIN, NO PUEDE ACCEDER
		// if($this->session->userdata('role') != 'admin'){
		// 	show_error('No estás autorizado');
		// }

		// Elimina el archivo
		$oldFile = $this->archivero_model->get_file_by_id($id);
		if ($oldFile && file_exists('./uploads/' . $oldFile->file)) {
			unlink('./uploads/' . $oldFile->file);
		}
		
		$this->archivero_model->delete_file($id);
		redirect('archivero');
	}

	
}