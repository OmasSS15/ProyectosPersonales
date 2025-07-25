<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursal_model extends CI_Model {
    public function __construct(){
        // CADA VEZ QUE SE LLAME EL CONSTRUCTOR VA IR ESTA LINEA
        parent::__construct();
        // CON ESTO REALIZAMOS LA CONEXION A LA BD
        $this->load->database();
    }

    public function get_all_sucursal() {
        // MUESTRA TODA LA LISTA DE LOS REGISTROS DE LA TABLA
        $query = $this->db->get('sucursales');
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        return $query->result();
    }
	
    public function get_sucursal_filter($idestado, $start_date, $end_date) {
        // MUESTRA TODA LA LISTA DE LOS REGISTROS DE LA TABLA
        $this->db->select(
            'sucursales.*,
            estados.estado'
        );
        $this->db->from('sucursales');
        $this->db->join('estados', 'estados.id = sucursales.idestado');
        if ($idestado) {
            $this->db->where('idestado', $idestado);
        }
        if ($start_date && $end_date) {
            $this->db->where('DATE(sucursales.created) >=', $start_date);
            $this->db->where('DATE(sucursales.created) <=', $end_date);
        } elseif ($start_date) {
            $this->db->where('DATE(sucursales.created) >=', $start_date);
        } elseif ($end_date) {
            $this->db->where('DATE(sucursales.created) <=', $end_date);
        }
        $query = $this->db->get();
        // LOS DATOS SE RETORNAN EN FORMA DE OBJETO
        // echo $this->db->last_query();
        return $query->result();
    }

    public function get_sucursal_by_id($id) {
         $this->db->select(
            'sucursales.*,
            estados.estado'
        );
        $this->db->from('sucursales');
        $this->db->join('estados', 'estados.id = sucursales.idestado');
        $this->db->where('sucursales.id', $id);
        $query = $this->db->get();
        return $query->row(); 
    }
	
    public function save_sucursal($sucursalData){
        //NOS PERMITE AÑADIR NUEVOS REGISTROS
        $this->db->insert('sucursales', $sucursalData);
    }

    public function update_sucursal($id, $sucursalData){
        // PARA ACTUALIZAR LOS REGISTROS
        $this->db->update('sucursales', $sucursalData, ['id' => $id]);
    }

    public function delete_sucursal($id){
        $this->db->delete('sucursales', ['id' => $id]);
    }

}
