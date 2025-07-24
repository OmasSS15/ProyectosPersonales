<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
    <?php $errors = $this->session->flashdata('errors'); ?>
    <div class="container my-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('Historial'); ?>">Historial</a></li>
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
                            <i class='bx bxs-book fs-1 me-1'></i>
                            <?php echo $title; ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Asunto:</th>
                                <td><?php echo $file->name; ?></td>
                            </tr>
                            <tr>
                                <th>Puesto:</th>
                                <td><?php echo $file->rol; ?></td>
                            </tr>
                            <tr>
                                <th>Responsable:</th>
                                <td><?php echo $file->user_name . ' ' . $file->user_lastname; ?></td>
                            </tr>
                            <tr>
                                <th>Clasificación:</th>
                                <td><?php echo $file->classification; ?></td>
                            </tr>
                            <tr>
                                <th>Sucursal:</th>
                                <td><?php echo $file->sucursal; ?></td>
                            </tr>
                            <tr>
                                <th>Descripción:</th>
                                <td class="wrap-text"><?php echo $file->description; ?></td>
                            </tr>
                            <tr>
                                <th>Archivo:</th>
                                <td>
                                    <a href="<?= base_url('uploads/' . $file->file) ?>" target="_blank">
                                        <?php echo $file->file ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Estado:</th>
                                <td class="d-flex align-items-center">
                                    <?php if($file->status == 1): ?>
                                        <i class='bx bxs-check-circle fs-5 me-1 text-success'></i>Verificado
                                    <?php elseif($file->status == 2): ?>
                                        <i class='bx bxs-time fs-5 me-1 text-warning'></i>Pendiente
                                    <?php else: ?>
                                        <i class='bx bxs-x-circle fs-5 me-1 text-danger'></i>Inválido
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Fecha y Hora de Envío:</th>
                                <td><?php echo (new DateTime($file->created))->format('Y/m/d h:i A'); ?></td>
                            </tr>
                            <tr>
                                <th>Última Modificación:</th>
                                <td><?php echo (new DateTime($file->updated))->format('Y/m/d h:i A'); ?></td>
                            </tr>
                            <tr>
                                <th>Comentarios:</th>
                                <td><?php echo $file->commentary; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>           
            </div>

                
        </div>
    </div>

</div>