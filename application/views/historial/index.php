<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>  
    <?php $success = $this->session->flashdata('success'); ?>  
    <div class="container my-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
            </ol>
        </nav>
        <?php if(isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between" style="font-size: 1.1rem;" role="alert">
                <div class="d-flex align-items-center">
                    <i class='bx bxs-check-circle fs-5 me-2'></i>
                    <span><?php echo $success; ?></span>
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- <div class="row"> -->
            <!-- <div class="col-12" id="tableColumn"> -->
                <div class="card shadow-lg">
                    <div class="card-header text-white py-3">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto ms-3">
                                <h3 class="mb-0 d-flex align-items-center">
                                    <i class='bx bxs-book fs-1 me-1'></i>
                                    <?php echo $title; ?>
                                </h3>
                            </div>
                            <div class="col-auto d-flex gap-2 me-3">
                                <a class="btn bg-btn rounded-start-pill shadow-sm d-flex align-items-center" href="<?php echo base_url('historial/upload'); ?>">
                                    <i class='bx bxs-file-plus fs-4 me-1'></i>
                                    Subir Archivo
                                </a>
                                <a class="btn bg-btn rounded-end-pill shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal_filter">
                                    <i class='bx bxs-filter-alt fs-4 me-1' ></i>
                                    Filtros
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable_historial" class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Asunto</th>
                                        <th class="text-center" scope="col">Clasificación</th>
                                        <th class="text-center" scope="col">Fecha de Envío</th>
                                        <th class="text-center" scope="col">Hora de Envío</th>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($files as $file): ?>
                                        <tr>
                                            <th class="text-center" scope="row"><?php echo $file->id; ?></th>
                                            <td class="text-center"><?php echo $file->name; ?></td>
                                            <td class="text-center"><?php echo $file->classification; ?></td>
                                            <?php $datetime = new DateTime($file->created); ?>
                                            <td class="text-center"><?= $datetime->format('Y/m/d') ?></td>
                                            <td class="text-center"><?= $datetime->format('h:i A') ?></td>
                                            <?php if($file->status == 1): ?>
                                                <td class="text-center"><i class='bx bxs-check-circle fs-5' style="color: green;" ></i></td>
                                            <?php elseif($file->status == 2): ?>
                                                <td class="text-center"><i class='bx bxs-time fs-5' style="color: #FFB300;" ></i></td>
                                            <?php else: ?>
                                                <td class="text-center"><i class='bx bxs-x-circle fs-5' style="color:rgb(187, 17, 17)" ></i></td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <?php if($file->status == 1): ?>
                                                        <a class="btn btn-danger" href="<?= base_url('uploads/' . $file->file); ?>" download>
                                                            <i class='bx bxs-download'></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <a class="btn btn-primary" href="<?= base_url('historial/show/' . $file->id); ?>">
                                                        <i class='bx bxs-show'></i>
                                                    </a>
                                                    <a class="btn btn-warning" href="<?= base_url('historial/edit/' . $file->id); ?>">
                                                        <i class='bx bxs-edit'></i>
                                                    </a>
                                                    <?php if($file->status == 0): ?>
                                                        <a class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#modal_delete_<?= $file->id; ?>">
                                                            <i class='bx bxs-trash'></i>
                                                        </a>
                                                        <!-- Modal Delete -->
                                                        <div class="modal fade" id="modal_delete_<?= $file->id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header text-white justify-content-center py-3">
                                                                        <h1 class="modal-title d-flex align-items-center fs-5" id="staticBackdropLabel">
                                                                            <i class='bx bxs-error fs-4 me-1' ></i>
                                                                            Atención
                                                                        </h1>
                                                                    </div>
                                                                    <div class="modal-body text-center py-4 px-3">
                                                                        Esta acción eliminará permanentemente el documento llamado <strong><?= $file->name; ?></strong>. ¿Deseas continuar?
                                                                    </div>
                                                                    <div class="modal-footer d-flex justify-content-center gap-2">
                                                                        <button type="button" class="btn btn btn-outline-modal d-flex align-items-center" data-bs-dismiss="modal">
                                                                            <i class='bx bxs-x-circle fs-5 me-1'></i>Cancelar
                                                                        </button>
                                                                        <a href="<?= base_url('historial/delete/' . $file->id); ?>" class="btn btn-modal d-flex align-items-center">
                                                                            <i class='bx bxs-check-circle fs-5 me-1'></i>Confirmar
                                                                        </a>  
                                                                    </div>       
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            <!-- </div> -->
            <!-- <div class="col-3"> -->
                <!-- Collapse -->
                <!-- <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                    </div>
                </div>
            </div> -->
        <!-- </div> -->
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="modal_filter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white py-3">
                    <h1 class="modal-title d-flex align-items-center fs-5" id="staticBackdropLabel">
                        <i class='bx bxs-filter-alt fs-4 me-1' ></i>
                        Filtros
                    </h1>
                    <button type="button" class="btn d-flex align-items-center ms-auto" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x fs-3' style="color: white;"></i></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="GET" action="<?php echo base_url('historial') ?>">
                        <div class="col-md-6">
                            <label for="clasificacion_file" class="form-label">Clasificación</label>
                            <select class="form-select" id="clasificacion" name="clasificacion_id">
                                <option value="" selected disabled>Seleccionar</option>
                                <?php foreach ($clasificaciones as $clasificacion): ?>
                                    <!-- ?= ... es la abreviatura de php echo ...  -->
                                    <option value="<?= $clasificacion->id ?>"
                                        <?= ($idclassification == $clasificacion->id) ? 'selected' : '' ?>>
                                        <?= $clasificacion->name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Desde</label>
                            <input type="text" class="form-control" id="start_date" name="start_date" value="<?= isset($start_date) ? $start_date : '' ?>" placeholder="Seleccionar fecha">
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Hasta</label>
                            <input type="text" class="form-control" id="end_date" name="end_date" value="<?= isset($end_date) ? $end_date : '' ?>" placeholder="Seleccionar fecha">
                        </div>
                        <div class="modal-footer">
                            <a href="<?php echo base_url('historial') ?>" class="btn btn btn-outline-modal d-flex align-items-center">
                                <i class='bx bxs-eraser fs-5 me-1'></i>Limpiar
                            </a>
                            <button type="submit" class="btn btn-modal d-flex align-items-center">
                                <i class='bx bx-search fs-5 me-1'></i>Aplicar
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    
</div>