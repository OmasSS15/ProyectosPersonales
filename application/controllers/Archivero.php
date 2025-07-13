<?php
// ESTA LINEA DE CODIGO ES IMPORTANTE Y TIENE QUE USARSE
defined('BASEPATH') OR exit('No direct script access allowed');

class Archivero extends CI_Controller {

	public function __construct(){	
		parent::__construct();
		$this->load->model('archivero_model');
		$this->load->model('clasificacion_model');
		$this->load->model('sucursal_model');
		date_default_timezone_set('America/Merida');
	}

	public function index()
	{
		$mainData = [
			'title' => 'Archivero',
			'content' => 'archivero/index',
			'files' => $this->archivero_model->get_all_files()
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
			'title' => 'Detalle de Archivo #' . $id,
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
		// $config['max_size'] = 10240; // tamaño maximo del archivo

		$new_name = date('YmdHis');

		$config = [
			'upload_path' => './uploads/', // ruta para guardar los archivos
			'allowed_types' => 'pdf|txt|xlsx', // archivos permitidos
			'max_size' => 10240,
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
				'iduser' => 1,
				'idclassification' => $this->input->post('clasificacion_id'),
				'idsucursal' => $this->input->post('sucursal_id'),
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
			'title' => 'Archivo #' . $id,
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

		$config = [
			'upload_path' => './uploads/', // ruta para guardar los archivos
			'allowed_types' => 'pdf|txt|xlsx', // archivos permitidos
			'max_size' => 10240
		];

		$this->load->library('upload', $config); // libreria para subir archivos

		$data = []; // Inicializamos por si no se sube archivo

		$fileData = [
			'name' => $this->input->post('name'),
			'iduser' => 1,
			'idclassification' => $this->input->post('clasificacion_id'),
			'idsucursal' => $this->input->post('sucursal_id'),
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

	
}