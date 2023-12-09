<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : index.php 
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/products/source-code-aplikasi-rental-mobil-php-mysql-7.html 
  | 
  | 
  | 
  | 
 */
    require '../../koneksi/koneksi.php';
    $title_web = 'User';
    include '../header.php';
    if(empty($_SESSION['USER']))
    {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Rental Mobil</title>
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" >
    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/88160970d4.js" crossorigin="anonymous"></script>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  </head>
  <body>
<br>
<div class="container">
    <h3 class="judul-tabel">Daftar User / Pelanggan</h3>
    <div class="card-index">
        <div class="card-header text-white bg-primary">
            <h5 class="card-title pt-2">
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =1;
                            $sql = "SELECT * FROM login WHERE level = 'Pengguna' ORDER BY id_login DESC";
                            $row = $koneksi->prepare($sql);
                            $row->execute();
                            $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                            foreach($hasil as $r){
                        ?>
                        <tr>
                            <td><?= $no;?></td>   
                            <td><?=$r->nama_pengguna;?></td>      
                            <td><?=$r->username;?></td>      
                            <td>
                                <a href="../booking/booking.php?id=<?= $r->id_login;?>" 
                                    class="btn btn-primary btn-sm">Detail Transaksi</a>    
                            </td>   
                        </tr>
                        <?php $no++; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php  include '../footer.php';?>