<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantenimiento_model extends CI_Model {
    public function __construct(){
        // CADA VEZ QUE SE LLAME EL CONSTRUCTOR VA IR ESTA LINEA
        parent::__construct();
        // CON ESTO REALIZAMOS LA CONEXION A LA BD
        $this->load->database();
    }

    public function get_all_files($idsucursal, $start_date, $end_date){
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
        $this->db->where('idclassification', 6);
        if ($idsucursal) {
            $this->db->where('files.idsucursal', $idsucursal);
        }
        if ($start_date && $end_date) {
            $this->db->where('DATE(files.created) >=', $start_date);
            $this->db->where('DATE(files.created) <=', $end_date);
        } elseif ($start_date) {
            $this->db->where('DATE(files.created) >=', $start_date);
        } elseif ($end_date) {
            $this->db->where('DATE(files.created) <=', $end_date);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function save_file($fileData){
        //NOS PERMITE AÑADIR NUEVOS REGISTROS
        $this->db->insert('files', $fileData);
    }

	public function get_file_by_id($id) {
        // PRIMERO SE COLOCA LA TABLA Y LUEGO EL ID
        $query = $this->db->get_where('files', ['id' => $id]);
        return $query->row(); // SE RETORNA A LA FILA QUE SE VA A MOSTRAR
    }

    public function get_file_by_id_filter($id) {
        $this->db->select(
            'files.*, 
            users.name as user_name, 
            users.lastname as user_lastname,
            roles.rol as rol,
            classification.name as classification,
            sucursales.sucursal as sucursal'
        );
        $this->db->from('files');
        $this->db->join('users', 'users.id = files.iduser');
        $this->db->join('roles', 'roles.id = users.idrol');
        $this->db->join('classification', 'classification.id = files.idclassification');
        $this->db->join('sucursales', 'sucursales.id = files.idsucursal');
        $this->db->where('files.id', $id);
        $query = $this->db->get();
        return $query->row(); 
    }

    public function update_file($id, $fileData){
        // PARA ACTUALIZAR LOS REGISTROS
        $this->db->update('files', $fileData, ['id' => $id]);
    }

    public function delete_file($id){
        $this->db->delete('files', ['id' => $id]);
    }
}
