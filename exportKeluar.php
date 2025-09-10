<?php
require 'function.php';
?>

<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>

<!-- START EXPORT LAPORAN KELUAR -->
<div class="container">
<h2>Stock Barang</h2>
<h4>(Inventory)</h4>
  <div class="data-tables datatable-dark">
  <h4 class="text-dark">Laporan Barang Keluar</h4>
    <table class="table-striped" id="mauexport">
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
          $ambildataproduk = mysqli_query($conn, "SELECT produk.idproduk, produk.kd_produk, produk.namaproduk, produk.stok, produk.hargajual, kategori.namakategori, keluar.tanggal, keluar.qty from keluar LEFT JOIN produk on produk.idproduk = keluar.idproduk LEFT JOIN kategori on produk.idkategori = kategori.idkategori");

          $i = 1;

          while($data=mysqli_fetch_array($ambildataproduk)){
            $idproduk = $data['idproduk'];
            $namaproduk = $data['namaproduk'];
            $kd_produk = $data['kd_produk'];
            $hargajual = $data['hargajual'];
            $namakategori = $data['namakategori'];
            $stok = $data['stok'];
            $qty = $data['qty'];
            $tanggal = $data['tanggal'];
            $jumlahlaba = $hargajual * $qty;
        ?>
            <tr>
              <td><?php echo $i++;?></td>
              <td><?php echo $kd_produk;?></td>
              <td><?php echo $namaproduk;?></td>
              <td><?php echo $namakategori;?></td>
              <td>Rp <?php echo number_format("$hargajual", 0, ",", ".")?></td>
              <td><?php echo $qty;?></td>
              <td>Rp <?php echo number_format("$jumlahlaba", 0, ",", ".")?></td>
              <td><?php echo date('d F Y', strtotime($data['tanggal']));?></td>
            </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- END EXPORT LAPORAN KELUAR -->
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>