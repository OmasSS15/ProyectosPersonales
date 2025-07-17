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
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Nombre Completo:</th>
                                <td><?php echo $user->user_name . ' ' . $user->user_lastname; ?></td>
                            </tr>
                            <tr>
                                <th>Correo Electrónico:</th>
                                <td><?php echo $user->email; ?></td>
                            </tr>
                            <tr>
                                <th>Contraseña:</th>
                                <td><?php echo $user->password; ?></td>
                            </tr>
                            <tr>
                                <th>Cargo:</th>
                                <td><?php echo $user->rol; ?></td>
                            </tr>
                            <tr>
                                <th>Sucursal:</th>
                                <td><?php echo $user->sucursal; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha y Hora del Registro:</th>
                                <td><?php echo (new DateTime($user->created))->format('Y/m/d h:i A'); ?></td>
                            </tr>
                            <tr>
                                <th>Última Modificación:</th>
                                <td><?php echo (new DateTime($user->updated))->format('Y/m/d h:i A'); ?></td>
                            </tr>
                            <tr>
                                <th>Estado:</th>
                                <td class="d-flex align-items-center">
                                    <?php if($user->status == 1): ?>
                                        <i class='bx bxs-check-circle fs-5 me-1 text-success'></i>Activo
                                    <?php else: ?>
                                        <i class='bx bxs-x-circle fs-5 me-1 text-danger'></i>Inactivo
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form method="post" action="<?php echo base_url('users/show_update/') . $user->id; ?>">
                        <div class="row container g-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Actualizar Estado:</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="" disabled>Seleccionar</option>
                                    <option value="1" <?= $user->status == '1' ? 'selected' : '' ?>>Activo</option>
                                    <option value="0" <?= $user->status == '0' ? 'selected' : '' ?>>Inactivo</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-modal d-flex align-items-center ms-auto">
                                    <i class='bx bxs-send fs-5 me-1'></i> Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form> 
                </div>           
            </div>

                
        </div>
    </div>

</div>