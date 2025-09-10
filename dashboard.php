<?php
session_start();
require 'function.php';

if (!isset($_SESSION['email'])) {
  header('location: index.php');
  exit();
}

$admin = $_SESSION['role'] === 'admin';

// Menghitung banyak produk
$cekdataproduk = mysqli_query($conn, "SELECT * from produk");
$hitung = mysqli_num_rows($cekdataproduk);

// Menghitun total semua stok
$cekstok = mysqli_query($conn, "SELECT sum(stok) as totalstok from produk");
$data = mysqli_fetch_array($cekstok);
$totalstok = $data['totalstok'] ?? 0;

// Menghitung jumlah laba
$sql_jumlah_laba = "SELECT IFNULL(SUM(produk.hargajual * keluar.qty), 0) AS laba
                    FROM produk
                    LEFT JOIN keluar ON keluar.idproduk = produk.idproduk";
$result_jumlah_laba = mysqli_query($conn, $sql_jumlah_laba);
if ($result_jumlah_laba) {
  $jumlah = mysqli_fetch_assoc($result_jumlah_laba);
  $jumlah_laba = $jumlah['laba'];
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard <?php if($admin) {echo "Admin";} else {echo "Manager Stok";}?>  - ClothStock</title>
    <style>
      .sb-sidenav .nav-link:hover {
        color: #0dcaf0 !important;
      }
    </style>
  </head>
  <body class="sb-nav-fixed">
    <?php
    include 'navbar.php';
    ?>
    <div id="layoutSidenav">
      <?php
      include 'sidebar.php';
      ?>
      <div id="layoutSidenav_content" class="bg-body-secondary">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <p class="text-secondary">Selamat datang, <?php if($admin) {echo "Admin";} else {echo "Manager Stok";}?> 😊</p>
          </div>

          <!-- Start Card  -->
          <div class="container-fluid d-flex flex-column gap-4 px-4">
            <div class="row">

            <!-- Menampilkan banyaknya produk -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                          <div class="text">
                            <h5 class="card-title text-secondary">Total Produk</h5>
                            <h2 class="card-text"><?=$hitung;?></h2>
                          </div>
                          <div class="icon bg-body-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fa-solid fa-cube text-info" style="height: 25px;"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Menampilkan total stok -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                          <div class="text">
                            <h5 class="card-title text-secondary">Total Stok</h5>
                            <h2 class="card-text"><?=$totalstok;?></h2>
                          </div>
                            <div class="icon bg-body-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fa-regular fa-clipboard text-info" style="height: 25px;"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Menampilkan jumlah laba -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                          <div class="text">
                            <h5 class="card-title text-secondary">Laba</h5>
                            <h2 class="card-text">Rp <?=number_format("$jumlah_laba", 0, ",", ".")?></h2>
                          </div>
                            <div class="icon bg-body-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fa-solid fa-circle-dollar-to-slot text-info" style="height: 25px;"></i></div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
        <!-- End Card -->
        </main>
      </div>
    </div>
  </body>
</html>
