<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Clase Personalizada
class MY_Controller extends CI_Controller {
    protected $allowed_roles = [];

    public function __construct() {
        parent::__construct();
        $this->check_access();

        // Verifica si hay sesión activa
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    protected function check_access() {
        if (!empty($this->allowed_roles)) {
            $user_role = $this->session->userdata('idrole');
            if (!in_array($user_role, $this->allowed_roles)) {
                // show_error('No tienes permiso para acceder.', 403);
                redirect('home');
            }
        }
    }
}