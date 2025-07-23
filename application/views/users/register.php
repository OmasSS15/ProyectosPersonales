<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
    <?php $errors = $this->session->flashdata('errors'); ?>
    <div class="container my-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('users'); ?>">Catálogo de Usuarios</a></li>
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
                            <i class='bx bxs-folder-open fs-1 me-1'></i>
                            <?php echo $title; ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('users/store'); ?>" method="post" enctype="multipart/form-data" class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre(s)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa un nombre(s)..." required>
                    </div>

                    <div class="col-md-6">
                        <label for="lastname" class="form-label">Apellido(s)</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Ingresa un apellido(s)..." required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa un correo electrónico..." required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa una contraseña..." required>
                    </div>

                    <div class="col-md-6">
                        <label for="rol" class="form-label">Cargo</label>
                        <select class="form-select" id="select" name="rol_id" required>
                            <option value="" selected disabled>Seleccionar</option>
                            <?php foreach ($roles as $rol): ?>
                                <!-- ?= ... es la abreviatura de php echo ...  -->
                                <option value="<?= $rol->id ?>">
                                    <?= $rol->rol ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="sucursal_file" class="form-label">Sucursal</label>
                        <select class="form-select" id="sucursal_file" name="sucursal_id" required>
                            <option value="" selected disabled>Seleccionar</option>
                            <?php foreach ($sucursales as $sucursal): ?>
                                <!-- ?= ... es la abreviatura de php echo ...  -->
                                <option value="<?= $sucursal->id ?>"><?= $sucursal->sucursal ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- <div class="col-md-6">
                        <label for="file" class="form-label">Seleccionar Archivo</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                        <small class="form-text text-muted d-block mt-1">
                            <i class='bx bx-info-circle'></i>
                            Archivos permitidos: <strong>PDF, TXT, Excel</strong>. Tamaño máximo: <strong>50 MB</strong>.
                        </small>
                    </div> -->

                    <div class="col-12">
                        <button type="submit" class="btn btn-modal d-flex align-items-center ms-auto">
                            <i class='bx bxs-send fs-5 me-1'></i> Registrar Usuario
                        </button>
                    </div>
                </form>
            </div>

                
        </div>
    </div>

</div>