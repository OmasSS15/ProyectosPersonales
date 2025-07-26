<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    public function __construct(){
        // CADA VEZ QUE SE LLAME EL CONSTRUCTOR VA IR ESTA LINEA
        parent::__construct();
        // CON ESTO REALIZAMOS LA CONEXION A LA BD
        $this->load->database();
    }

    public function get_users_filters($idsucursal, $idrol, $start_date, $end_date, $idrol_user, $idsucursal_user){
        $this->db->select(
            'users.*, 
            users.name as user_name, 
            users.lastname as user_lastname,
            roles.rol as rol,
            sucursales.sucursal as sucursal'
        );
        $this->db->from('users');
        $this->db->join('roles', 'roles.id = users.idrol');
        $this->db->join('sucursales', 'sucursales.id = users.idsucursal');
        // Filtrar por Sucursal con respecto al rol
        if ($idrol_user !=1){
            $this->db->where('users.idsucursal', $idsucursal_user);
        }
        // Filtros
        if ($idsucursal) {
            $this->db->where('idsucursal', $idsucursal);
        }
        if ($idrol) {
            $this->db->where('idrol', $idrol);
        }
        if ($start_date && $end_date) {
            $this->db->where('DATE(users.created) >=', $start_date);
            $this->db->where('DATE(users.created) <=', $end_date);
        } elseif ($start_date) {
            $this->db->where('DATE(users.created) >=', $start_date);
        } elseif ($end_date) {
            $this->db->where('DATE(users.created) <=', $end_date);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user_by_id($id) {
        $this->db->select(
            'users.*, 
            users.name as user_name, 
            users.lastname as user_lastname,
            roles.rol as rol,
            sucursales.sucursal as sucursal'
        );
        $this->db->from('users');
        $this->db->join('roles', 'roles.id = users.idrol');
        $this->db->join('sucursales', 'sucursales.id = users.idsucursal');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        return $query->row(); 
    }

    public function get_user_by_email($email){
        $this->db->where('status', 1);
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row();
    }


    public function save_user($userData){
        //NOS PERMITE AÑADIR NUEVOS REGISTROS
        $this->db->insert('users', $userData);
    }

    public function update_user($id, $userData){
        // PARA ACTUALIZAR LOS REGISTROS
        $this->db->update('users', $userData, ['id' => $id]);
    }

    public function delete_user($id){
        $this->db->delete('users', ['id' => $id]);
    }


}