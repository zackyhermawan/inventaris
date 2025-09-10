<?php
session_start();
require 'function.php';
if (!isset($_SESSION['email'])) {
  header('location: index.php');
  exit();
}

if (isset($_POST['export'])) {
  header('location: exportKeluar.php');
}

if (isset($_POST['reset'])) {
  header('location: laporanKeluar.php');
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
  <title>Laporan - ClothStock</title>
</head>
<body class="sb-nav-fixed">
  <?php include 'navbar.php'; ?>
  <div id="layoutSidenav">
    <?php include 'sidebar.php'; ?>

    <!-- START TABLE LAPORAN KELUAR -->
    <div id="layoutSidenav_content" class="bg-body-secondary">
      <main>
        <div class="container-fluid px-4">
          <div class="card shadow-sm mt-4 mb-4">
            <div class="card-header bg-white d-flex align-items-center justify-content-between">
              <h4 class="text-info">Laporan Barang Keluar</h4>
              <!-- Filter Laporan By Bulan -->
              <div class="filter my-2 d-flex justify-content-center">
                <form method="GET" class="d-flex">
                  <select name="bulan" class="form-select ms-2">
                    <option selected>Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                  <button class="border-0 ms-2 px-3 text-white bg-info rounded" type="submit">Filter</button>
                  <button name="reset" class="border-0 px-2 ms-2 text-white bg-secondary rounded">Reset</button>
                </form>
              </div>
              <!-- End Filter Laporan By Bulan -->
            </div>
            <div class="card-body">
              <table class="table-striped" id="datatablesSimple">
                <thead>
                  <tr>
                    <th class="table-dark">No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Jumlah Keluar</th>
                    <th>Laba Penjualan</th>
                    <th>Tanggal Keluar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $whereClause = "";
                  if (isset($_GET['bulan']) && $_GET['bulan'] != "Pilih Bulan") {
                    $bulan = $_GET['bulan'];
                    $whereClause = "WHERE MONTH(keluar.tanggal) = '$bulan'";
                  }

                  $query = "
                    SELECT 
                      produk.idproduk, 
                      produk.kd_produk, 
                      produk.namaproduk, 
                      produk.hargajual, 
                      kategori.namakategori, 
                      keluar.tanggal, 
                      keluar.qty 
                    FROM keluar 
                    LEFT JOIN produk ON produk.idproduk = keluar.idproduk 
                    LEFT JOIN kategori ON produk.idkategori = kategori.idkategori 
                    $whereClause
                  ";
                  $ambildataproduk = mysqli_query($conn, $query);

                  $i = 1;
                  while ($data = mysqli_fetch_array($ambildataproduk)) {
                    $idproduk = $data['idproduk'];
                    $namaproduk = $data['namaproduk'];
                    $kd_produk = $data['kd_produk'];
                    $hargajual = $data['hargajual'];
                    $namakategori = $data['namakategori'];
                    $qty = $data['qty'];
                    $tanggal = $data['tanggal'];
                    $jumlahlaba = $hargajual * $qty;
                  ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $kd_produk; ?></td>
                      <td><?= $namaproduk; ?></td>
                      <td><?= $namakategori; ?></td>
                      <td>Rp <?= number_format("$hargajual", 0, ",", ".") ?></td>
                      <td><?= $qty; ?></td>
                      <td>Rp <?= number_format("$jumlahlaba", 0, ",", ".") ?></td>
                      <td><?= date('d F Y', strtotime($tanggal)); ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
              <form method="post" target="_blank">
                <button type="submit" name="export" class="text-center border-0 bg-transparent d-flex m-auto" style="cursor: pointer;"><i class="fa-solid fa-cloud-arrow-down py-2 px-4 fs-5 text-white bg-primary rounded-pill"></i></button>
              </form>
            </div>
          </div>
        </div>
      </main>
    </div>
    <!-- END TABLE LAPORAN KELUAR -->
  </div>
</body>
</html>
