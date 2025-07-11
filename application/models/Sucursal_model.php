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
	
	
}
