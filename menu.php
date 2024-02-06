<?php

include "conf/confconexion.php";
$moest=mysqli_query($objConexion,"select * from tb_configuracion");
$mombre = mysqli_fetch_array($moest);

session_start();
$idrolUsuario=$_SESSION['idRolUsuario_S'];
$user =  $_SESSION['nombreUsuario_S'];
?> 

<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="img/logiin.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $mombre['nombre'] ?> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $user ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="#"  class="nav-link " id="dashboard-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link " id="dashboard-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard </p>
                </a>
              </li>
            
             
            </ul>
          </li>
     
          <li class="nav-item ">
            <a href="#" class="nav-link" id="link_2">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Administracion
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($idrolUsuario==1){

               ?>
              <li class="nav-item">
                <a href="usuario.php" class="nav-link" id="link_2">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuario</p>
                </a>
              </li>
              <?php
              }
              ?>
              <li class="nav-item">
                <a href="salir.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cerrar sesion</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar <small>+ Custom Area</small></p>
                </a>
              </li> -->
         
          
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="link_3">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Personas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="clientes.php" class="nav-link" id="link_3">
                  <i class="far fa-circle nav-icon"></i>
                  <p>cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="proveedor.php" class="nav-link" id="link_3">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedor</p>
                </a>
              </li>
            
           
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="link_4">
              <i class="nav-icon fas fa-tag"></i>
              <p>
               Productos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category.php" class="nav-link" id="link_4">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categoria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="producto.php" class="nav-link" id="link_4">
                  <i class="far fa-circle nav-icon"></i>
                  <p>productos</p>
                </a>
              </li>
            
            
           
           
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="link_5">
              <i class="nav-icon fas fa-truck"></i>
              <p>
             inventario
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="compra.php" class="nav-link" id="link_5">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compras</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="datos_compra.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>datos compra</p>
                </a>
              </li> -->
            
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="link_6">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
               Ventas 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="venta.php" class="nav-link" id="link_6">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ventas </p>
                </a>
              </li>
            
           
            </ul>
          </li>
          <li class="nav-header">Reportes</li>
          <li class="nav-item">
            <a href="ventas_detalle.php" class="nav-link" id="link_7">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                reporte venta 
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="datos_inventario.php" class="nav-link" id="link_9">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                reporte compra
              </p>
            </a>
          </li>
        
         
        
         
     
          
        
          
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>