<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : peminjaman.php 
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/products/source-code-aplikasi-rental-mobil-php-mysql-7.html 
  | 
  | 
  | 
  | 
 */
    require '../../koneksi/koneksi.php';
    $title_web = 'Peminjaman';
    include '../header.php';
    if(empty($_SESSION['USER']))
    {
        session_start();
    }
    if(!empty($_GET['id'])){
        $kode_booking = $_GET['id'];
        
        $hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

        $id_booking = $hasil['id_booking'];
        if(!isset($id_booking))
        {
            echo '<script>alert("Tidak Ada Data !");window.location="peminjaman.php"</script>';
        }
        $hsl = $koneksi->query("SELECT * FROM pembayaran WHERE id_booking = '$id_booking'")->fetch();


        $id = $hasil['id_mobil'];
        $isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Rental Mobil</title>
    <link rel="stylesheet" href="peminjaman.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" >
    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/88160970d4.js" crossorigin="anonymous"></script>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  </head>
  <body>
<br>
<br>
<div class="container">
<a class="back-btn btn-warning" href="../booking/bayar.php" role="button"><i class="fa-solid fa-angle-left" style="margin-right: 7px;"></i>Kembali</a>
<div class="row">
    <div class="col-sm-12">
        <div class="card-peminjaman">
            <div class="card-header">
                <h3 style="margin-bottom: 15px;"> Cari Booking</h3>
            </div>
            <div class="card-body">
                <form method="get" action="peminjaman.php">
                    <input type="text" class="form-control" 
                    value="<?php if(!empty($_GET['id'])){ echo $_GET['id']; }?>" name="id" placeholder="Tulis Kode Booking [ ENTER ]">
                </form>
            </div>
        </div>
        <br>
    </div>
    <?php if(!empty($_GET['id'])){?>
    <div class="col-sm-4">
        <div class="card-peminjaman">
            <div class="card-header">
                <h3 style="margin-bottom: 15px;"> Detail Pembayaran</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>No Rekening</td>
                        <td> :</td>
                        <td><?= $hsl['no_rekening'];?></td>
                    </tr>
                    <tr>
                        <td>Atas Nama </td>
                        <td> :</td>
                        <td><?= $hsl['nama_rekening'];?></td>
                    </tr>
                    <tr>
                        <td>Nominal  </td>
                        <td> :</td>
                        <td>Rp. <?= number_format($hsl['nominal']);?></td>
                    </tr>
                    <tr>
                        <td>Tgl  Transfer</td>
                        <td> :</td>
                        <td><?= $hsl['tanggal'];?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br/>
        <div class="card-peminjaman">
            <div class="card-header">
                <h3 class="card-title" style="margin-bottom: 15px;"><?php echo $isi['merk'];?></h3>
            </div>
                <ul class="list-group list-group-flush">
                <?php if($isi['status'] == 'Tersedia'){?>
                    <li class="list-group-item bg-primary text-white">
                        <i class="fa fa-check"></i> Available
                    </li>
                <?php }else{?>
                    <li class="list-group-item bg-danger text-white">
                        <i class="fa fa-close"></i> Not Available
                    </li>
                <?php }?>
                <li class="list-group-item bg-info text-white"><i class="fa fa-check"></i> Free E-toll 50k</li>
                <li class="list-group-item bg-dark text-white">
                    <i class="fa fa-money"></i> Rp. <?php echo number_format($isi['harga']);?>/ day
                </li>
            </ul>
        </div>
    </div>
    <div class="col-sm-8">
         <div class="card-peminjaman">
            <div class="card-header">
                <h3 class="card-title" style="margin-bottom: 15px;">Detail Booking & Status Mobil</h3>
            </div>
           <div class="card-body">
               <form method="post" action="proses.php?id=konfirmasi">
                    <table class="table">
                        <tr>
                            <td>Kode Booking  </td>
                            <td> :</td>
                            <td><?php echo $hasil['kode_booking'];?></td>
                        </tr>
                        <tr>
                            <td>KTP  </td>
                            <td> :</td>
                            <td><?php echo $hasil['ktp'];?></td>
                        </tr>
                        <tr>
                            <td>Nama  </td>
                            <td> :</td>
                            <td><?php echo $hasil['nama'];?></td>
                        </tr>
                        <tr>
                            <td>telepon  </td>
                            <td> :</td>
                            <td><?php echo $hasil['no_tlp'];?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Sewa </td>
                            <td> :</td>
                            <td><?php echo $hasil['tanggal'];?></td>
                        </tr>
                        <tr>
                            <td>Lama Sewa </td>
                            <td> :</td>
                            <td><?php echo $hasil['lama_sewa'];?> hari</td>
                        </tr>
                        <tr>
                            <td>Total Harga </td>
                            <td> :</td>
                            <td>Rp. <?php echo number_format($hasil['total_harga']);?></td>
                        </tr>
                        <tr>
                            <td>Status Mobil</td>
                            <td> :</td>
                            <td>
                                <select class="form-control" name="status">
                                    <option <?php if($isi['status'] == 'Tersedia'){echo 'selected';}?> value="Tersedia">
                                        Tersedia ( Kembali )
                                    </option>
                                    <option <?php if($isi['status'] == 'Tidak Tersedia'){echo 'selected';}?> value="Tidak Tersedia">
                                        Tidak Tersedia ( Pinjam )
                                    </option>
                                </select>    
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="id_mobil" value="<?php echo $isi['id_mobil'];?>">
                    <button type="submit" class="btn btn-primary float-right">
                        Ubah Status
                    </button>
            </form>
               
           </div>
         </div> 
    </div>
    <?php }?>
</div>
</div>
<br>
<br>
<br>
<?php  include '../footer.php';?>