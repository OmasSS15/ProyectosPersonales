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
                                    <i class='bx bxs-category fs-1 me-1'></i>
                                    <?php echo $title; ?>
                                </h3>
                            </div>
                            <div class="col-auto d-flex gap-2 me-3">
                                <a class="btn bg-btn rounded-3 shadow-sm d-flex align-items-center" href="<?php echo base_url('clasificacion/create'); ?>">
                                    <i class='bx bxs-plus-circle fs-4 me-1'></i>
                                    Añadir Clasificación
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable_rol" class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Clasificación</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clasificaciones as $clasificacion): ?>
                                        <tr>
                                            <th class="text-center" scope="row"><?php echo $clasificacion->id; ?></th>
                                            <td class="text-center"><?php echo $clasificacion->name; ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <a class="btn btn-warning" href="<?= base_url('clasificacion/edit/' . $clasificacion->id); ?>">
                                                        <i class='bx bxs-edit'></i>
                                                    </a>
                                                    <a class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#modal_delete_<?= $clasificacion->id; ?>">
                                                        <i class='bx bxs-trash'></i>
                                                    </a>
                                                    <!-- Modal Delete -->
                                                    <div class="modal fade" id="modal_delete_<?= $clasificacion->id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header text-white justify-content-center py-3">
                                                                    <h1 class="modal-title d-flex align-items-center fs-5" id="staticBackdropLabel">
                                                                        <i class='bx bxs-error fs-4 me-1' ></i>
                                                                        Atención
                                                                    </h1>
                                                                </div>
                                                                <div class="modal-body text-center py-4 px-3">
                                                                    Esta acción eliminará permanentemente la clasificación de <strong><?= $clasificacion->name; ?></strong>. ¿Deseas continuar?
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center gap-2">
                                                                    <button type="button" class="btn btn btn-outline-modal d-flex align-items-center" data-bs-dismiss="modal">
                                                                        <i class='bx bxs-x-circle fs-5 me-1'></i>Cancelar
                                                                    </button>
                                                                    <a href="<?= base_url('clasificacion/delete/' . $clasificacion->id); ?>" class="btn btn-modal d-flex align-items-center">
                                                                        <i class='bx bxs-check-circle fs-5 me-1'></i>Confirmar
                                                                    </a>  
                                                                </div>       
                                                            </div>
                                                        </div>
                                                    </div>
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
    
</div>