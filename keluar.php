<?php
session_start();
require 'function.php';
if (!isset($_SESSION['email'])) {
  header('location: index.php');
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
    <title>Barang Keluar - ClothStock</title>
    
  </head>
  <body class="sb-nav-fixed">
    <?php
    include 'navbar.php';
    ?>
    <div id="layoutSidenav">
      <?php
      include 'sidebar.php';
      ?>

      <!-- START TABLE BARANG KELUAR -->
      <div id="layoutSidenav_content" class="bg-body-secondary">
        <main>
          <div class="container-fluid px-4">
            <div class="card shadow-sm mt-4 mb-4">
              <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <h4 class="text-info">Barang Keluar</h4>
                <a class="btn btn-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-plus me-2"></i>Tambah Barang Keluar</a>
              </div>
              <div class="card-body">
              <table class="table-striped" id="datatablesSimple">
                  <thead>
                    <tr>
                      <th class="table-dark">Tanggal</th>
                      <th>Nama Produk</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $datakeluar = mysqli_query($conn, "SELECT * from keluar m, produk s where s.idproduk = m.idproduk");
                      $i = 1;

                      while($data = mysqli_fetch_array($datakeluar)){
                        $namaproduk = $data['namaproduk'];
                        $qty = $data['qty'];
                        $tanggal = $data['tanggal'];
                        $idkl = $data['idkeluar'];

                    ?>
                      <tr>
                        <td><?=$tanggal;?></td>
                        <td><?=$namaproduk;?></td>
                        <td><?=$qty;?></td>
                        <td>
                          <a href="" data-bs-toggle="modal" data-bs-target="#edit<?=$idkl;?>"><i class="fa-solid fa-pen-to-square bg-info p-2 text-white rounded"></i></a>
                          <a href="" data-bs-toggle="modal" data-bs-target="#delete<?=$idkl;?>"><i class="fa-solid fa-trash-can bg-danger p-2 text-white rounded"></i></a>
                        </td>
                      </tr>
                      <!-- Edit Barang Keluar -->
                      <div class="modal fade" id="edit<?=$idkl;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Barang Keluar</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form method="post">
                                <div class="modal-body">
                                  <input type="hidden" name="idmasuk" value="<?=$idkl;?>">
                                  <input type="hidden" name="idproduk" value="<?=$data['idproduk'];?>">
                                  <input type="hidden" name="qtylama" value="<?=$qty;?>">
                                  <label>Nama Produk</label>
                                  <input type="text" value="<?=$namaproduk;?>" class="form-control" readonly>
                                  <br>
                                  <label>Jumlah</label>
                                  <input type="number" name="qtybaru" value="<?=$qty;?>" class="form-control" required/>
                                  <br />
                                  <button type="submit" class="btn btn-info text-white" name="editbarangkeluar">Edit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Edit Barang Keluar -->

                      <!-- Hapus Barang Keluar -->
                      <div class="modal fade" id="delete<?=$idkl;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Barang Keluar</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form method="post">
                                <div class="modal-body">
                                  <input type="hidden" name="idkeluar" value="<?=$idkl;?>">
                                  <input type="hidden" name="idproduk" value="<?=$data['idproduk'];?>">
                                  <input type="hidden" name="qty" value="<?=$qty;?>">
                                  <p class="fw-semibold">Apakah anda yakin ingin menghapus barang <?=$namaproduk;?>?</p>
                                  <button type="submit" class="btn btn-danger text-white" name="hapusbarangkeluar">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Hapus Barang Keluar -->

                    <?php
                      }
                    ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </main>
      </div>
      <!-- END TABLE BARANG KELUAR -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang Keluar</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post">
            <div class="modal-body">
              <select name="barangnya" class="form-control">
                <option value="">-- Pilih Kode Barang --</option>
                <?php
                  $dataproduk = mysqli_query($conn, "SELECT * FROM produk");
                  while($fetcharray = mysqli_fetch_array($dataproduk)){
                    $kd_produk = $fetcharray['kd_produk'];
                    $idproduk = $fetcharray['idproduk'];
                    ?>
                  <option value="<?=$idproduk;?>"><?=$kd_produk;?></option>
                  <?php
                  }
                ?>
              </select>
              <br>
              <input type="number" name="qty" placeholder="Jumlah" class="form-control" />
              <br />
              <button type="submit" class="btn btn-info text-white" name="addbarangkeluar">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</html>
