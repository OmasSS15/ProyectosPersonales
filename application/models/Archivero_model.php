<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archivero_model extends CI_Model {
    public function __construct(){
        // CADA VEZ QUE SE LLAME EL CONSTRUCTOR VA IR ESTA LINEA
        parent::__construct();
        // CON ESTO REALIZAMOS LA CONEXION A LA BD
        $this->load->database();
    }

    public function get_all_files() {
        $this->db->select(
            'files.*, 
            users.name as user_name, 
            users.lastname as user_lastname,
            classification.name as classification,
            sucursales.sucursal as sucursal'
        );
        $this->db->from('files');
        $this->db->join('users', 'users.id = files.iduser');
        $this->db->join('classification', 'classification.id = files.idclassification');
        $this->db->join('sucursales', 'sucursales.id = files.idsucursal');
        $query = $this->db->get();
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }

    public function save_file($fileData){
        //NOS PERMITE AÑADIR NUEVOS REGISTROS
        $this->db->insert('files', $fileData);
    }

	public function get_id_file($id) {
        // PRIMERO SE COLOCA LA TABLA Y LUEGO EL ID
        $query = $this->db->get_where('files', ['id' => $id]);
        return $query->row(); // SE RETORNA A LA FILA QUE SE VA A MOSTRAR
    }

    public function update_file($id, $fileData){
        // PARA ACTUALIZAR LOS REGISTROS
        $this->db->update('files', $fileData, ['id' => $id]);
    }
}
