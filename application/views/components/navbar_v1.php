<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-expand-sm py-3">
  <div class="container-fluid">
    <div class="ms-3">
        <h3>Titulo</h3>
    </div>
    <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="ms-auto me-3 mt-3 mt-md-0 mt-lg-0">
          <i class='bx bxs-moon mx-3'></i>
          <i class="bx bx-bell"></i> <span class="badge rounded-pill bg-danger me-3">3</span>
          <img src="<?php echo base_url('assets/img/profile.png'); ?>" class="rounded-circle" alt="profile">
      </div>
    </div>
    
  </div>
</nav>