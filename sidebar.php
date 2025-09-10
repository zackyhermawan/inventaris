<?php
$role = $_SESSION['role'] ?? 'guest';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
      .sb-sidenav .nav-link:hover {
        color: #0dcaf0 !important;
      }

      .sb-sidenav .nav-link.logout:hover {
        color: red !important;
      }

    </style>
  </head>
  <body class="sb-nav-fixed">
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu bg-white">
            <div class="nav">
              <a class="nav-link text-dark-emphasis" href="dashboard.php">
                <div class="sb-nav-link-icon text-dark-emphasis"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
              </a>
              <div class="sb-sidenav-menu-heading text-secondary-emphasis">Barang</div>
              <?php if($role === 'admin'): ?>
              <a class="nav-link text-dark-emphasis" href="barang.php">
                <div class="sb-nav-link-icon text-dark-emphasis"><i class="fa-solid fa-box"></i></div>
                List Barang
              </a>
              <?php endif; ?>
              <a class="nav-link text-dark-emphasis" href="masuk.php">
                <div class="sb-nav-link-icon text-dark-emphasis"><i class="fa-solid fa-box-open"></i></div>
                Barang Masuk
              </a>
              <a class="nav-link text-dark-emphasis" href="keluar.php">
                <div class="sb-nav-link-icon text-dark-emphasis"><i class="fa-solid fa-dolly"></i></div>
                Barang Keluar
              </a>

              <?php if($role === 'admin'): ?>
              <a class="nav-link text-dark-emphasis" href="kategori.php">
                <div class="sb-nav-link-icon text-dark-emphasis"><i class="fa-solid fa-cubes"></i></div>
                Kategori
              </a>
              <?php endif; ?>
              <a class="menu laporan-aside nav-link position-relative text-decoration-none text-dark-emphasis" data-bs-toggle="collapse" href="#laporan" role="button" aria-expanded="false" aria-controls="laporan">
                <div class="sb-nav-link-icon text-dark-emphasis"><i class="fa-solid fa-file"></i></div>
                Laporan <i class="fa-solid fa-caret-down mx-3"></i>
              </a>
                <div class="kelolastok-dropdown collapse" id="laporan">
                  <ul class="list-unstyled d-flex ms-3 flex-column gap-2">
                    <li class="d-flex align-items-center"><a href="laporanMasuk.php" class="menu d-flex p-1 nav-link text-dark-emphasis"><p class="submenu-dropdown m-0"><i class="fa-solid fa-inbox mx-2"></i>Laporan Masuk</p></a></li>
                    <li class="d-flex align-items-center"><a href="laporanKeluar.php" class="menu p-1 d-flex nav-link text-dark-emphasis"><p class="submenu-dropdown m-0"><i class="fa-solid fa-arrow-up-from-bracket mx-2"></i>Laporan Keluar</p></a></li>
                  </ul>
                </div>
                <?php if($role === 'admin'): ?>
              <div class="sb-sidenav-menu-heading text-secondary-emphasis">User</div>
              <a class="nav-link text-dark-emphasis" href="users.php">
                <div class="sb-nav-link-icon text-dark-emphasis"><i class="fa-solid fa-address-card"></i></div>
                Data Pengguna
              </a>
              <?php endif; ?>
              <a class="nav-link logout text-danger mt-4" href="logout.php">
                <div class="sb-nav-link-icon text-danger"><i class="fa-solid fa-right-from-bracket"></i></div>
                Logout
              </a>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
