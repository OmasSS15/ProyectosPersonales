<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rol_model extends CI_Model {
    public function __construct(){
        // CADA VEZ QUE SE LLAME EL CONSTRUCTOR VA IR ESTA LINEA
        parent::__construct();
        // CON ESTO REALIZAMOS LA CONEXION A LA BD
        $this->load->database();
    }

    public function get_all_rol() {
        // MUESTRA TODA LA LISTA DE LOS REGISTROS DE LA TABLA
        $query = $this->db->get('roles');
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }

    public function get_rol_filter($idrol_user) {
        // Filtrar Clasificaciones, excepto el Admin
        if (!in_array($idrol_user, [1])){
            $this->db->where('visible', 1); // Solo los activos se muestran
        }
        $query = $this->db->get('roles');
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }
	
	public function get_rol_by_id($id) {
        // PRIMERO SE COLOCA LA TABLA Y LUEGO EL ID
        $query = $this->db->get_where('roles', ['id' => $id]);
        return $query->row(); // SE RETORNA A LA FILA QUE SE VA A MOSTRAR
    }
	
    public function save_rol($rolData){
        //NOS PERMITE AÑADIR NUEVOS REGISTROS
        $this->db->insert('roles', $rolData);
    }

    public function update_rol($id, $rolData){
        // PARA ACTUALIZAR LOS REGISTROS
        $this->db->update('roles', $rolData, ['id' => $id]);
    }

    public function delete_rol($id){
        $this->db->delete('roles', ['id' => $id]);
    }

}
