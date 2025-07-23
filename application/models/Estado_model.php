<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado_model extends CI_Model {
    public function __construct(){
        // CADA VEZ QUE SE LLAME EL CONSTRUCTOR VA IR ESTA LINEA
        parent::__construct();
        // CON ESTO REALIZAMOS LA CONEXION A LA BD
        $this->load->database();
    }

    public function get_all_estado() {
        // MUESTRA TODA LA LISTA DE LOS REGISTROS DE LA TABLA
        $query = $this->db->get('estados');
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }

    public function get_estado_filter() {
        // MUESTRA TODA LA LISTA DE LOS REGISTROS DE LA TABLA
        $this->db->where('status', 1);
        $query = $this->db->get('estados');
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }
	
    public function get_estado_by_id($id) {
        // PRIMERO SE COLOCA LA TABLA Y LUEGO EL ID
        $query = $this->db->get_where('estados', ['id' => $id]);
        return $query->row(); // SE RETORNA A LA FILA QUE SE VA A MOSTRAR
    }
	
    public function save_estado($estadoData){
        //NOS PERMITE AÑADIR NUEVOS REGISTROS
        $this->db->insert('estados', $estadoData);
    }

    public function update_estado($id, $estadoData){
        // PARA ACTUALIZAR LOS REGISTROS
        $this->db->update('estados', $estadoData, ['id' => $id]);
    }

    public function delete_estado($id){
        $this->db->delete('estados', ['id' => $id]);
    }
	
}
