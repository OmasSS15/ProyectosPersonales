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
                                    <i class='bx bxs-user-circle fs-1 me-1'></i>
                                    <?php echo $title; ?>
                                </h3>
                            </div>
                            <div class="col-auto d-flex gap-2 me-3">
                                <a class="btn bg-btn rounded-start-pill shadow-sm d-flex align-items-center" href="<?php echo base_url('users/register'); ?>">
                                    <i class='bx bxs-user-plus fs-4 me-1'></i>
                                    Registrar Usuario
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
                            <table id="datatable_users" class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Nombre</th>
                                        <th class="text-center" scope="col">Correo Electrónico</th>
                                        <th class="text-center" scope="col">Puesto</th>
                                        <th class="text-center" scope="col">Sucursal</th>
                                        <th class="text-center" scope="col">Fecha</th>
                                        <th class="text-center" scope="col">Hora</th>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <th scope="row"><?php echo $user->id; ?></th>
                                            <td><?php echo $user->user_name . ' ' . $user->user_lastname; ?></td>
                                            <td><?php echo $user->email; ?></td>
                                            <td><?php echo $user->rol; ?></td>
                                            <td><?php echo $user->sucursal; ?></td>
                                            <?php $datetime = new DateTime($user->created); ?>
                                            <td><?= $datetime->format('Y/m/d') ?></td>
                                            <td><?= $datetime->format('h:i A') ?></td>
                                            <?php if($user->status == 1): ?>
                                                <td><i class='bx bxs-check-circle fs-5' style="color: green;" ></i></td>
                                            <?php elseif($user->status == 2): ?>
                                                <td><i class='bx bxs-time fs-5' style="color: #FFB300;" ></i></td>
                                            <?php else: ?>
                                                <td><i class='bx bxs-x-circle fs-5' style="color:rgb(187, 17, 17)" ></i></td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="d-flex align-items-center flex-wrap gap-1">
                                                    <a class="btn btn-primary" href="<?= base_url('users/show/' . $user->id); ?>">
                                                        <i class='bx bxs-show'></i>
                                                    </a>
                                                    <a class="btn btn-warning" href="<?= base_url('users/edit/' . $user->id); ?>">
                                                        <i class='bx bxs-edit'></i>
                                                    </a>
                                                    <?php if($user->status == 0): ?>
                                                        <a class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                            <i class='bx bxs-trash'></i>
                                                        </a>
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
                    <form class="row g-3" method="GET" action="<?php echo base_url('users') ?>">
                        <div class="col-md-6">
                            <label for="sucursal_file" class="form-label">Sucursal</label>
                            <select class="form-select" id="sucursal" name="sucursal_id">
                                <option value="" selected disabled>Seleccionar</option>
                                <?php foreach ($sucursales as $sucursal): ?>
                                    <!-- ?= ... es la abreviatura de php echo ...  -->
                                    <option value="<?= $sucursal->id ?>"
                                        <?= ($idsucursal == $sucursal->id) ? 'selected' : '' ?>>
                                        <?= $sucursal->sucursal ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="rol" class="form-label">Cargo</label>
                            <select class="form-select" id="rol" name="rol_id">
                                <option value="" selected disabled>Seleccionar</option>
                                <?php foreach ($roles as $rol): ?>
                                    <!-- ?= ... es la abreviatura de php echo ...  -->
                                    <option value="<?= $rol->id ?>"
                                        <?= ($idrol == $rol->id) ? 'selected' : '' ?>>
                                        <?= $rol->rol ?>
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
                            <a href="<?php echo base_url('users') ?>" class="btn btn btn-outline-modal d-flex align-items-center">
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

    <!-- Modal Delete -->
    <div class="modal fade" id="modal_delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header text-white justify-content-center py-3">
                    <h1 class="modal-title d-flex align-items-center fs-5" id="staticBackdropLabel">
                        <i class='bx bxs-error fs-4 me-1' ></i>
                        Atención
                    </h1>
                </div>
                <div class="modal-body text-center py-4 px-3">
                    Esta acción eliminará permanentemente el registro. ¿Deseas continuar?
                </div>
                <div class="modal-footer d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn btn-outline-modal d-flex align-items-center" data-bs-dismiss="modal">
                        <i class='bx bxs-x-circle fs-5 me-1'></i>Cancelar
                    </button>
                    <a href="<?= base_url('users/delete/' . $user->id); ?>" class="btn btn-modal d-flex align-items-center">
                        <i class='bx bxs-check-circle fs-5 me-1'></i>Confirmar
                    </a>  
                </div>       
            </div>
        </div>
    </div>
</div>