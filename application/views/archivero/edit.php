<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
    <?php $errors = $this->session->flashdata('errors'); ?>
    <div class="container my-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('archivero'); ?>">Archivero</a></li>
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
                <form action="<?php echo base_url('archivero/update/') . $file->id; ?>" method="post" enctype="multipart/form-data" class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Asunto</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $file->name; ?>" placeholder="Ingresa un nombre..." required>
                    </div>

                    <div class="col-md-6">
                        <label for="clasificacion_file" class="form-label">Clasificación</label>
                        <select class="form-select" id="clasificacion_file" name="clasificacion_id" required>
                            <option value="" selected disabled>Seleccionar</option>
                            <?php foreach ($clasificaciones as $clasificacion): ?>
                                <!-- ?= ... es la abreviatura de php echo ...  -->
                                <option value="<?= $clasificacion->id ?>"
                                    <?= $file->idclassification == $clasificacion->id ? 'selected' : '' ?>>
                                    <?= $clasificacion->name ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- <div class="col-md-6">
                        <label for="sucursal_file" class="form-label">Sucursal</label>
                        <select class="form-select" id="sucursal_file" name="sucursal_id" required>
                            <option value="" selected disabled>Seleccionar</option>
                            <?php foreach ($sucursales as $sucursal): ?>
                                 ?= ... es la abreviatura de php echo ...
                                <option value="<?= $sucursal->id ?>"
                                    <?= $file->idsucursal == $sucursal->id ? 'selected' : '' ?>>
                                    <?= $sucursal->sucursal ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div> -->
                    
                    <!-- <div class="col-md-6">
                        <label for="status" class="form-label">Actualizar Estado</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="" selected disabled>Seleccionar</option>
                            <option value="2" <?= $file->status == '2' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="1" <?= $file->status == '1' ? 'selected' : '' ?>>Verificado</option>
                            <option value="0" <?= $file->status == '0' ? 'selected' : '' ?>>Inválido</option>
                        </select>
                    </div> -->

                    <div class="col-md-6">
                        <label for="file" class="form-label">Archivo Actual: 
                            <a href="<?= base_url('uploads/' . $file->file) ?>" target="_blank">
                                <?= $file->file ?>
                            </a>
                        </label>
                        <input type="file" class="form-control" id="file" name="file">
                        <small class="form-text text-muted d-block mt-1">
                            <i class='bx bx-info-circle'></i>
                            Archivos permitidos: <strong>PDF, TXT, Excel</strong>. Tamaño máximo: <strong>50 MB</strong>.
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Escribe una breve descripción si es necesario..."><?php echo htmlspecialchars($file->description); ?></textarea>
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