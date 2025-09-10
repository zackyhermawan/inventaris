<?php
session_start();
require 'function.php';
if (!isset($_SESSION['email'])) {
  header('location: index.php');
  exit();
}

if(isset($_POST['export'])){
  header('location: exportMasuk.php');
}

if(isset($_POST['reset'])){
  header('location: laporanMasuk.php');
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
    <?php
    include 'navbar.php';
    ?>
    <div id="layoutSidenav">
      <?php
      include 'sidebar.php';
      ?>

      <!-- STAR TABLE LAPORAN MASUK -->
      <div id="layoutSidenav_content" class="bg-body-secondary">
        <main>
          <div class="container-fluid px-4">
            <div class="card shadow-sm mt-4 mb-4">
              <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <h4 class="text-info">Laporan Barang Masuk</h4>
                <!-- Filter Laporan By Bulan -->
                <div class="filter my-2 d-flex justify-content-center">
                  <form method="GET" class="d-flex ">
                    <select name="bulan" class="form-select ms-2">
                      <option selected value="">Pilih Bulan</option>
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
                    <button name="reset" class="border-0 px-2 ms-2 text-white bg-secondary rounded" type="submit">Reset</button>
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
                      <th>Total Stok</th>
                      <th>Harga Jual</th>
                      <th>Stok Masuk</th>
                      <th>Tanggal Masuk</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : "";

                      // Query dengan filter bulan jika ada
                      if ($bulan) {
                        $ambildataproduk = mysqli_query($conn, "SELECT produk.idproduk, produk.kd_produk, produk.namaproduk, produk.stok, produk.hargajual, kategori.namakategori, masuk.tanggal, masuk.qty FROM masuk LEFT JOIN produk ON produk.idproduk = masuk.idproduk LEFT JOIN kategori ON produk.idkategori = kategori.idkategori WHERE MONTH(masuk.tanggal) = '$bulan'");
                      } else {
                        $ambildataproduk = mysqli_query($conn, "SELECT produk.idproduk, produk.kd_produk, produk.namaproduk, produk.stok, produk.hargajual, kategori.namakategori, masuk.tanggal, masuk.qty FROM masuk LEFT JOIN produk ON produk.idproduk = masuk.idproduk LEFT JOIN kategori ON produk.idkategori = kategori.idkategori");
                      }

                      $i = 1;
                      while($data = mysqli_fetch_array($ambildataproduk)) {
                        $idproduk = $data['idproduk'];
                        $namaproduk = $data['namaproduk'];
                        $kd_produk = $data['kd_produk'];
                        $hargajual = $data['hargajual'];
                        $namakategori = $data['namakategori'];
                        $stok = $data['stok'];
                        $qty = $data['qty'];
                        $tanggal = $data['tanggal'];
                    ?>
                        <tr>
                          <td><?=$i++;?></td>
                          <td><?=$kd_produk;?></td>
                          <td><?=$namaproduk;?></td>
                          <td><?=$namakategori;?></td>
                          <td><?=$stok;?></td>
                          <td><?=$hargajual;?></td>
                          <td><?=$qty;?></td>
                          <td><?=date('d F Y', strtotime($tanggal));?></td>
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
      <!-- END TABLE LAPORAN MASUK -->
    </div>
  </body>
</html>
