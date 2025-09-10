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
    <title>Kategori - ClothStock</title>
  </head>
  <body class="sb-nav-fixed">
    <?php
    include 'navbar.php';
    ?>
    <div id="layoutSidenav">
      <?php
      include 'sidebar.php';
      ?>

      <!-- START TABLE KATEGORI -->
      <div id="layoutSidenav_content" class="bg-body-secondary">
        <main>
          <div class="container-fluid px-4">
            <div class="card shadow-sm mt-4 mb-4">
              <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <h4 class="text-info">Kategori</h4>
                <a class="btn btn-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-plus me-2"></i>Tambah Kateogri</a>
              </div>
              <div class="card-body">
                <table class="table-striped" id="datatablesSimple">
                  <thead>
                    <tr>
                      <th class="table-dark">No</th>
                      <th>Nama Kategori</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $ambildata = mysqli_query($conn, "SELECT * from kategori");
                      $i = 1;

                      while($data = mysqli_fetch_array($ambildata)){
                        $namakategori = $data['namakategori'];
                        $idk = $data['idkategori'];
                    ?>
                      <tr>
                        <td><?=$i++;?></td>
                        <td><?=$namakategori;?></td>
                        <td>
                          <a href="" data-bs-toggle="modal" data-bs-target="#edit<?=$idk;?>"><i class="fa-solid fa-pen-to-square bg-info p-2 text-white rounded"></i></a>
                          <a href="" data-bs-toggle="modal" data-bs-target="#delete<?=$idk;?>"><i class="fa-solid fa-trash-can bg-danger p-2 text-white rounded"></i></a>
                        </td>
                    </tr>
                    <!-- Edit Kategori -->
                    <div class="modal fade" id="edit<?=$idk;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form method="post">
                              <div class="modal-body">
                                <input type="hidden" name="idkategori" value="<?=$idk;?>">
                                <label>Nama Kategori</label>
                                <input type="text" name="namakategori" class="form-control" value="<?=$namakategori;?>" required>
                                <br>
                                <button type="submit" class="btn btn-info text-white" name="editkategori">Edit</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Edit Kategori -->

                    <!-- Hapus Kategori -->
                    <div class="modal fade" id="delete<?=$idk;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Kategori</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form method="post">
                              <div class="modal-body">
                                <input type="hidden" name="idkategori" value="<?=$idk;?>">
                                <p class="fw-semibold">Apakah anda yakin ingin menghapus kateogri <?=$namakategori;?>?</p>
                                <button type="submit" class="btn btn-danger text-white" name="hapuskategori">Hapus</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Hapus Kategori -->
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
      <!-- END TABLE KATEGORI -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
  <!-- Tambah Kateogri -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="modal-body">
              <input type="text" name="namakategori" class="form-control" placeholder="Nama Kategori" required>
              <br>
              <button type="submit" class="btn btn-info text-white" name="addnewkategori">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</html>
