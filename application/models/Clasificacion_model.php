<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clasificacion_model extends CI_Model {
    public function __construct(){
        // CADA VEZ QUE SE LLAME EL CONSTRUCTOR VA IR ESTA LINEA
        parent::__construct();
        // CON ESTO REALIZAMOS LA CONEXION A LA BD
        $this->load->database();
    }

    public function get_all_classification() {
        // MUESTRA TODA LA LISTA DE LOS REGISTROS DE LA TABLA
        $query = $this->db->get('classification');
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }

    public function get_classification_filter_files() {
        $this->db->where('status', 1); // Solo los activos se muestran
        $query = $this->db->get('classification');
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }

    public function get_classification_filter_rol($idrol_user) {
        // Filtrar Clasificaciones, excepto el Admin
        if (!in_array($idrol_user, [1, 2])){
            $this->db->where('status', 1); // Solo los activos se muestran
        }
        $query = $this->db->get('classification');
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }
	
    public function get_classification_by_id($id) {
        // PRIMERO SE COLOCA LA TABLA Y LUEGO EL ID
        $query = $this->db->get_where('classification', ['id' => $id]);
        return $query->row(); // SE RETORNA A LA FILA QUE SE VA A MOSTRAR
    }
	
    public function save_classification($classificationData){
        //NOS PERMITE AÑADIR NUEVOS REGISTROS
        $this->db->insert('classification', $classificationData);
    }

    public function update_classification($id, $classificationData){
        // PARA ACTUALIZAR LOS REGISTROS
        $this->db->update('classification', $classificationData, ['id' => $id]);
    }

    public function delete_classification($id){
        $this->db->delete('classification', ['id' => $id]);
    }
	
}
