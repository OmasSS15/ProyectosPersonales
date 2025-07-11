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
                                    <i class='bx bxs-folder-open fs-1 me-1'></i>
                                    Archivero
                                </h3>
                            </div>
                            <div class="col-auto d-flex gap-2 me-3">
                                <a class="btn bg-btn rounded-start-pill shadow-sm d-flex align-items-center" href="<?php echo base_url('archivero/upload'); ?>">
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
                            <table id="datatable_files" class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Nombre del Archivo</th>
                                        <th class="text-center" scope="col">Empleado</th>
                                        <th class="text-center" scope="col">Clasificación</th>
                                        <th class="text-center" scope="col">Sucursal</th>
                                        <th class="text-center" scope="col">Fecha</th>
                                        <th class="text-center" scope="col">Hora</th>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($files as $file): ?>
                                        <tr>
                                            <th scope="row"><?php echo $file->id; ?></th>
                                            <td><?php echo $file->name; ?></td>
                                            <td><?php echo $file->user_name . ' ' . $file->user_lastname; ?></td>
                                            <td><?php echo $file->classification; ?></td>
                                            <td><?php echo $file->sucursal; ?></td>
                                            <?php $datetime = new DateTime($file->updated); ?>
                                            <td><?= $datetime->format('Y/m/d') ?></td>
                                            <td><?= $datetime->format('h:i A') ?></td>
                                            <?php if($file->status == 1): ?>
                                                <td><i class='bx bxs-check-circle fs-5' style="color: green;" ></i></td>
                                            <?php elseif($file->status == 2): ?>
                                                <td><i class='bx bxs-time fs-5' style="color: #FFB300;" ></i></td>
                                            <?php else: ?>
                                                <td><i class='bx bxs-x-circle fs-5' style="color:rgb(187, 17, 17)" ></i></td>
                                            <?php endif; ?>
                                            <td>
                                                <?php if($file->status == 1): ?>
                                                    <a class="btn btn-danger me-1" href=""><i class='bx bxs-download'></i></a>
                                                <?php endif; ?>
                                                <a class="btn btn-warning" href="<?php echo base_url('archivero/edit/') . $file->id; ?>"><i class='bx bxs-edit'></i></a>
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

    <!-- Modal -->
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
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="clasificacion" class="form-label">Clasificación</label>
                            <select class="form-select" id="clasificacion">
                                <option selected>Seleccionar</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sucursal" class="form-label">Sucursal</label>
                            <select class="form-select" id="sucursal">
                                <option selected>Seleccionar</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha" class="form-label">Fecha</label>
                            <select class="form-select" id="fecha">
                                <option selected>Seleccionar</option>
                                <option>...</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-modal">Limpiar</button>
                    <button type="button" class="btn btn-modal">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
</div>