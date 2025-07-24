<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
    <?php $errors = $this->session->flashdata('errors'); ?>
    <div class="container my-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('finanza'); ?>">Finanza</a></li>
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
                            <i class='bx bxs-coin-stack fs-1 me-1'></i>
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
                                    <?php if(($file->iduser == $this->session->userdata('user_id')) || (in_array($this->session->userdata('idrol'), [1, 2])) || ($file->status == 1)): ?>
                                        <a href="<?= base_url('uploads/' . $file->file) ?>" target="_blank">
                                            <?= $file->file ?>
                                        </a>
                                    <?php else: ?>
                                        <a style="pointer-events: none; color: gray; text-decoration: none;">
                                            <?= $file->file ?>
                                        </a>
                                    <?php endif; ?>
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
                    <?php if(in_array($this->session->userdata('idrol'), [1, 2])): ?>
                        <form method="post" action="<?php echo base_url('finanza/show_update/') . $file->id; ?>">
                            <div class="row container g-3">
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Actualizar Estado:</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="" disabled>Seleccionar</option>
                                        <option value="2" <?= $file->status == '2' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="1" <?= $file->status == '1' ? 'selected' : '' ?>>Verificado</option>
                                        <option value="0" <?= $file->status == '0' ? 'selected' : '' ?>>Inválido</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="comment" class="form-label">Comentarios:</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Añade un comentario si es necesario..."></textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-modal d-flex align-items-center ms-auto">
                                        <i class='bx bxs-send fs-5 me-1'></i> Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?> 
                </div>           
            </div>

                
        </div>
    </div>

</div>