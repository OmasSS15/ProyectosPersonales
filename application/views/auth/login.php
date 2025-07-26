<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <!-- Boxicons CSS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />

    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />

    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css"
    rel="stylesheet"
    />

    <!-- CUSTOM CSS -->
    <link href="<?php echo base_url('assets/css/bg_animated2.css'); ?>" rel="stylesheet"/>

    </head>
<body>
    <div class='box'>
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
    </div>
    <?php $errors = $this->session->flashdata('errors'); ?>
    <?php $form_errors = $this->session->flashdata('form_errors'); ?>
    <section class="vh-100 position-relative" style="z-index: 1;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                     <?php if(isset($errors)): ?>
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between" style="font-size: 1.1rem;" role="alert">
                            <div class="d-flex align-items-center">
                                <i class='bx bxs-x-circle fs-5 me-2'></i>
                                <span><?php echo $errors; ?></span>
                            </div>
                            <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="<?php echo base_url('assets\img\bg_dunosusa.jpg'); ?>"
                                alt="login form" class="img-fluid h-100 w-100" style="object-fit: cover; border-radius: 1rem 0 0 1rem;"/>
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="<?php echo base_url('auth/login'); ?>" method="POST" enctype="multipart/form-data" >
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img width="302" src="<?php echo base_url('assets/img/dunosusa-logo.png'); ?>" alt="logo"/>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicia sesión para continuar</h5>

                                        <div class="mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="email" name="email" class="form-control form-control-lg" value="<?= !empty($input_value['email']) ? $input_value['email'] : ''; ?>"/>
                                                <label class="form-label" for="email">Dirección de correo electrónico</label>
                                            </div>
                                            <?php if (!empty($form_errors['email'])): ?>
                                                <small class="form-text text-danger d-flex mb-0 pb-0">
                                                    <i class='bx bx-info-circle fs-5 me-1'></i>
                                                    <?php echo $form_errors['email']; ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                                <label class="form-label" for="password">Contraseña</label>
                                            </div>
                                            <?php if (!empty($form_errors['password'])): ?>
                                                <small class="form-text text-danger d-flex mb-0 pb-0">
                                                    <i class='bx bx-info-circle fs-5 me-1'></i>
                                                    <?php echo $form_errors['password']; ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Iniciar Sesión</button>
                                        </div>

                                        <!-- <a class="small text-muted" href="#!">Forgot password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                                            style="color: #393f81;">Register here</a></p> -->
                                        <!-- <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a> -->
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"
    ></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>


</html>