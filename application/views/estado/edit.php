<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
    <?php $errors = $this->session->flashdata('errors'); ?>
    <div class="container my-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('estados'); ?>">Catálogo de Estados</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
            </ol>
        </nav>
        <?php if(isset($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between" style="font-size: 1.1rem;" role="alert">
                <div class="d-flex align-items-center">
                    <i class='bx bxs-x-circle fs-5 me-2'></i>
                    <span><?php echo $errors; ?></span>
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="card shadow-lg">
            <div class="card-header text-white py-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto ms-3">
                        <h3 class="mb-0 d-flex align-items-center">
                            <i class='bx bxs-map fs-1 me-1'></i>
                            <?php echo $title; ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('estados/update/') . $estado->id; ?>" method="post" enctype="multipart/form-data" class="row g-3">

                    <div class="col-md-6">
                        <label for="name" class="form-label">Lugar</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $estado->estado; ?>" placeholder="Ingresa un nombre(s)..." required>
                    </div>

                    <div class="col-md-6">
                        <label for="abrev" class="form-label">Abreviatura</label>
                        <input type="text" class="form-control" id="abrev" name="abrev" value="<?php echo $estado->abrev; ?>" placeholder="Ingresa una abreviación..." required>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Actualizar Estado:</label>
                        <select name="status" id="select" class="form-select" required>
                            <option value="" disabled>Seleccionar</option>
                            <option value="1" <?= $estado->status == '1' ? 'selected' : '' ?>>Activo</option>
                            <option value="0" <?= $estado->status == '0' ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>
        
                    <div class="col-12">
                        <button type="submit" class="btn btn-modal d-flex align-items-center ms-auto">
                            <i class='bx bxs-send fs-5 me-1'></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>

                
        </div>
    </div>

</div>