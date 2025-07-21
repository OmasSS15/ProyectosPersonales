<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Clase Personalizada
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Verifica si hay sesión activa
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }
}