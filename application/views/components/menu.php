<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
                <div class="d-flex justify-content-between p-4">
                    <div class="sidebar-logo">
                        <a href="#"><img width="140" src="<?php echo base_url('assets/img/logoD.png'); ?>" alt="logo" style="margin: 0 1px 0" /></a>
                    </div>
                    <button class="toggle-btn border-0 ms-2" type="button">
                        <i id="icon" class='bx bx-chevrons-right'></i>
                    
                    </button>
                </div>             
                <ul class="sidebar-nav"> 
                    <li class="sidebar-item px-2 mb-2">
                        <a href="<?php echo base_url('home'); ?>" class="sidebar-link">
                            <i class='bx bxs-home'></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-2 mb-2">
                        <a href="<?php echo base_url('archivero'); ?>" class="sidebar-link">
                            <i class='bx bxs-folder-open'></i>
                            <span>Archivero</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-2 mb-2">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class='bx bx-list-ul'></i>
                            <span>Catálogos</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="sidebar">
                            <li class="sidebar-item mb-2">
                                <a href="<?php echo base_url('users'); ?>" class="sidebar-link">
                                   Usuarios 
                                </a>
                            </li>
                            <li class="sidebar-item mb-2">
                                <a href="<?php echo base_url('sucursales'); ?>" class="sidebar-link">
                                   Sucursales 
                                </a>
                            </li>
                            <li class="sidebar-item mb-2">
                                <a href="<?php echo base_url('estados'); ?>" class="sidebar-link">
                                   Estados
                                </a>
                            </li>
                            <li class="sidebar-item mb-2">
                                <a href="<?php echo base_url('roles'); ?>" class="sidebar-link">
                                   Roles 
                                </a>
                            </li>
                            <li class="sidebar-item mb-2">
                                <a href="#" class="sidebar-link">
                                   Clasificación
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item px-2">
                        <a href="<?php echo base_url('rh'); ?>" class="sidebar-link">
                            <i class='bx bxs-group'></i>
                            <span>Recursos Humanos</span>
                        </a>
                    </li> 
                    <li class="sidebar-item px-2">
                        <a href="<?php echo base_url('finanza'); ?>" class="sidebar-link">
                            <i class='bx bxs-coin-stack' ></i>
                            <span>Finanzas</span>
                        </a>
                    </li> 
                    <li class="sidebar-item px-2">
                        <a href="<?php echo base_url('mantenimiento'); ?>" class="sidebar-link">
                            <i class='bx bxs-cog' ></i>
                            <span>Mantenimiento</span>
                        </a>
                    </li>  
                    <li class="sidebar-item px-2">
                        <a href="<?php echo base_url('historial'); ?>" class="sidebar-link">
                            <i class='bx bxs-book'></i>
                            <span>Historial</span>
                        </a>
                    </li>    
                </ul>              
                <div class="sidebar-footer px-2 pb-2">
                    <a href="<?php echo base_url('auth/logout') ?>" class="sidebar-link">
                        <i class='bx bx-log-out'></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>