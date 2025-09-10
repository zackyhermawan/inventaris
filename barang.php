<?php
session_start();
require 'function.php';
if (!isset($_SESSION['email'])) {
  header('location: index.php');
  exit();
}

if ($_SESSION['role'] !== 'admin') {
  echo "<script>
        alert('Anda bukan admin. Anda tidak dapat mengakses halaman ini.');
        window.location.href = 'dashboard.php';
        </script>";
  exit();
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
    <title>List Barang - ClothStock</title>
    
  </head>
  <body class="sb-nav-fixed">
    <?php
    include 'navbar.php';
    ?>
    <div id="layoutSidenav">
      <?php
      include 'sidebar.php';
      ?>

      <!-- START TABLE LIST BARANG -->
      <div id="layoutSidenav_content" class="bg-body-secondary">
        <main>
          <div class="container-fluid px-4">
            <div class="card shadow-sm mt-4 mb-4">
              <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <h4 class="text-info">List Barang</h4>
                <a class="btn btn-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-plus me-2"></i>Tambah Barang</a>
              </div>
              <div class="card-body">
                <table class="table-striped" id="datatablesSimple">
                  <thead>
                    <tr>
                      <th class="table-dark">No</th>
                      <th>Kode Barang</th>
                      <th>Nama Produk</th>
                      <th>Kategori</th>
                      <th>Jumlah</th>
                      <th>Harga Beli</th>
                      <th>Harga Jual</th>
                      <th>Laba Per Barang</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $databarang = mysqli_query($conn, "SELECT * FROM produk m, kategori s where s.idkategori = m.idkategori");
                    $i = 1;
                    while($data=mysqli_fetch_array($databarang)){
                      $kd_produk = $data['kd_produk'];
                      $namaproduk = $data['namaproduk'];
                      $namakategori = $data['namakategori'];
                      $idb = $data['idproduk'];
                      $hargabeli = $data['hargabeli'];
                      $hargajual = $data['hargajual'];
                      $stok = $data['stok'];
                      $laba_per_barang = $hargajual - $hargabeli;
                    ?>
                      <tr>
                      <td><?=$i++;?></td>
                      <td><?=$kd_produk;?></td>
                      <td><?=$namaproduk;?></td>
                      <td><?=$namakategori;?></td>
                      <td><?=$stok;?></td>
                      <td>Rp <?=number_format($hargabeli, 0, ',', '.');?></td>
                      <td>Rp <?=number_format($hargajual, 0, ',', '.');?></td>
                      <td>Rp <?=number_format($laba_per_barang, 0, ',', '.');?></td>
                      <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#edit<?=$idb;?>"><i class="fa-solid fa-pen-to-square bg-info p-2 text-white rounded"></i></a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#delete<?=$idb;?>"><i class="fa-solid fa-trash-can bg-danger p-2 text-white rounded"></i></a>
                      </td>
                    </tr>
                    <!-- Modal Edit Barang -->
                    <div class="modal fade" id="edit<?=$idb;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form method="post">
                              <div class="modal-body">
                              <input type="hidden" name="idproduk" value="<?=$idb;?>">
                                <label>Kode Barang</label>
                                <input type="text" name="kd_produk" value="<?=$kd_produk;?>" class="form-control" />
                                <br/>
                                <label>Nama Barang</label>
                                <input type="text" name="namaproduk" value="<?=$namaproduk;?>" class="form-control" required />
                                <br />
                                <label>Kategori</label>
                                <select name="kategori" class="form-control">
                                  <option value="">-- Pilih Kategori --</option>
                                  <?php
                                    $datakategori = mysqli_query($conn, "SELECT * FROM kategori");
                                    while($fetcharray = mysqli_fetch_array($datakategori)){
                                      $selected = ($fetcharray['idkategori'] == $data['idkategori']) ? "selected" : "";
                                      echo "<option value='".$fetcharray['idkategori']."' $selected>".$fetcharray['namakategori']."</option>";
                                    }
                                  ?>
                                </select>
                                <br/>
                                <label>stok</label>
                                <input type="number" name="stok" value="<?=$stok;?>" class="form-control" readonly/>
                                <br />
                                <label>Harga Beli</label>
                                <input type="number" name="hargabeli" value="<?=$hargabeli;?>" class="form-control" required/>
                                <br />
                                <label>Harga Jual</label>
                                <input type="number" name="hargajual" value="<?=$hargajual;?>" class="form-control" required/>
                                <br />
                                <button type="submit" class="btn btn-info text-white" name="updatebarang">Edit</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal Tambah Barang -->

                    <!-- Modal Hapus Barang -->
                    <div class="modal fade" id="delete<?=$idb;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form method="post">
                              <div class="modal-body">
                              <input type="hidden" name="idproduk" value="<?=$idb;?>">
                              <input type="hidden" name="idkategori" value="<?=$idk;?>">
                              <input type="hidden" name="namaproduk" value="<?=$namaproduk;?>">
                              <p class="fw-semibold">Apakah anda yakin ingin menghapus barang <?=$namaproduk;?>?</p>  
                              <br>
                              <button type="submit" class="btn btn-danger text-white" name="deletebarang">Hapus</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal Hapus Barang -->
                    <?php
                    } 
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </main>
      </div>
      <!-- END TABLE LIST BARANG -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
  <!-- Modal Tambah Barang -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post">
            <div class="modal-body">
              <input type="text" name="namaproduk" placeholder="Nama Produk" class="form-control" required />
              <br />
              <input type="text" name="kd_produk" placeholder="Kode Barang" class="form-control" />
              <br/>
              <select name="kategorinya" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                <?php
                  $ambilsemuadata = mysqli_query($conn, "SELECT * FROM kategori");
                  while($fetcharray = mysqli_fetch_array($ambilsemuadata)){
                    $namakategori = $fetcharray['namakategori'];
                    $idkategori = $fetcharray['idkategori'];
                    ?>
                  <option value="<?=$idkategori;?>"><?=$namakategori;?></option>
                  <?php
                  }
                ?>
              </select>
              <br/>
              <input type="number" name="hargabeli" placeholder="Harga Beli" class="form-control" />
              <br />
              <input type="number" name="hargajual" placeholder="Harga Jual" class="form-control" />
              <br />
              <input type="number" name="stok" placeholder="Stok" class="form-control" />
              <br />
              <button type="submit" class="btn btn-info text-white" name="addnewbarang">Kirim</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</html>
