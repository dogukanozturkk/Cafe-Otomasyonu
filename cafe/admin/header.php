<?php
error_reporting(0); 

ob_start();
session_start();
include '../config/db.php';
include '../config/functions.php';

if(!isset($_SESSION['admin_name'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="tr-TR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="plugins/dist/css/adminlte.min.css">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  
    
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Anasayfa</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">İletişim Bilgileri</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="plugins/dist/img/AdminLTELogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light ml-3">Cafe Admin</span>
            </div>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mb-2 text-center text-light">
                    <p class="mt-2 mb-1">Hoşgeldin Admin</p>
                    <p class="mb-2"><?php echo $_SESSION["admin_name"]; ?></p>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user nav-icon"></i>
                                <p>
                                    Admin
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admin Bilgileri</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Çıkış Yap</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu">
                            <a href="masalar.php" class="nav-link">
                                <i class="fas fa-th nav-icon"></i>
                                <p>Masalar</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="type.php" class="nav-link">
                                <i class="fas fa-bookmark nav-icon"></i>
                                <p>Türler</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="brand.php" class="nav-link">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Markalar</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="stock.php" class="nav-link">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Stok</p>
                            </a>
                        </li> 
                        <li class="nav-item menu">
                            <a href="product.php" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Ürünler</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="satislar.php" class="nav-link">
                                <i class="fas fa-th nav-icon"></i>
                                <p>Satışlar</p>
                            </a>
                        </li>
                        
                        <!-- 
                        <li class="nav-item menu">
                            <a href="stock.php" class="nav-link">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Stok</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="seller.php" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Satıcılar</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="product.php" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Ürünler</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="type.php" class="nav-link">
                                <i class="fas fa-bookmark nav-icon"></i>
                                <p>Türler</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="brand.php" class="nav-link">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Markalar</p>
                            </a>
                        </li>
                       
                        <li class="nav-item menu">
                            <a href="#" class="nav-link">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Menü</p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="#" class="nav-link">
                                <i class="fas fa-th nav-icon"></i>
                                <p>Simple Link</p>
                            </a>
                        </li>
                    -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>