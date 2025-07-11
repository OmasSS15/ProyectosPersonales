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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.3.2/datatables.min.css" rel="stylesheet" integrity="sha384-nt2TuLL4RlRQ9x6VTFgp009QD7QLRCYX17dKj9bj51w2jtWUGFMVTveRXfdgrUdx" crossorigin="anonymous">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/menu.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/navbar.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/footer.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/datatable.css'); ?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet"/>

    </head>
<body>
    <div class="wrapper">
            <aside id="sidebar">
                <?php $this->load->view('components/menu'); ?>
            </aside>
            <div class="main d-flex flex-column min-vh-100 m-0 p-0">
                <!-- Navbar -->
                <?php $this->load->view('components/navbar'); ?>
                <!-- Content -->
                <main class="flex-grow-1">
                    <?php $this->load->view($content); ?>
                </main>
                <!-- Footer -->
                <?php $this->load->view('components/footer'); ?>
            </div>
        </div> 
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <!-- DataTables -->
    <!-- <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script> -->
    <script src="https://cdn.datatables.net/v/bs5/dt-2.3.2/datatables.min.js" integrity="sha384-rL0MBj9uZEDNQEfrmF51TAYo90+AinpwWp2+duU1VDW/RG7flzbPjbqEI3hlSRUv" crossorigin="anonymous"></script>
    
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/menu.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/datatable.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/select2.js'); ?>"></script>

</html>