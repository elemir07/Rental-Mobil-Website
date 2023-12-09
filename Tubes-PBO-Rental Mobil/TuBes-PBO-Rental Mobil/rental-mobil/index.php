<?php

require 'koneksi/koneksi.php';
if(empty($_SESSION['USER']))
{
    session_start();
}
include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    

<div id="carouselId" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php 
            $querymobil =  $koneksi -> query('SELECT * FROM mobil ORDER BY id_mobil DESC')->fetchAll();
            $no =1;
            foreach($querymobil as $isi)
            {
        ?>
        <li data-target="#carouselId" data-slide-to="<?= $no;?>" class="<?php if($no == '1'){ echo 'active';}?>"></li>
        <?php $no++;}?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php 
            $no =1;
            foreach($querymobil as $isi)
            {
        ?>
        <div class="carousel-item <?php if($no == '1'){ echo 'active';}?>">
            <img src="assets/image/<?= $isi['gambar'];?>" alt="First slide" 
            class="d-block w-100">
            <div class="mobil-carousel">
                <h1 class="card-title"><?php echo $isi['merk'];?></h1>
                <a href="detail.php?id=<?php echo $isi['id_mobil'];?>" class="detail"><button>Rent Now</button></a>
            </div>
        </div>
        <?php $no++;}?>
    </div>
    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="favcars mt-5">
<center><h2>Favorite Cars</h2></center>
    <div class="favorite-car mt-5">
        <div class="row">
        <?php 
            $query =  $koneksi -> query('SELECT * FROM mobil ORDER BY id_mobil DESC limit 3')->fetchAll();
            $no =1;
            foreach($query as $isi)
                {
            ?>
            <div class="fav col-3"><a href="detail.php?id=<?php echo $isi['id_mobil'];?>" class="detail"><img src="assets/image/<?php echo $isi['gambar'];?>" class="card-img-top" style="height:200px; width:300px;"></a><h5 class="card-title"><?php echo $isi['merk'];?></h5></div>
            <?php $no++;}?>
        </div>
    </div>
</div>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-4">
                    <div class="filter">
                        <h3>Filter</h3>
                        <hr>
                        <div class="search-bx">
                    <form class="form-inline" method="get" action="blog.php">
                        <input class="form-control mr-sm-2" type="search" name="cari" placeholder="Search here..." aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><img src="./assets/image/search.png" alt="" width="20px"></button>
                    </form>
                    <form action="" method="GET">
                        <div class="card-body">
                                <h4>Merek Mobil</h4>
                                <?php
                                    $con = mysqli_connect("localhost","root","","codekop_free_rental_mobil");

                                    $brand_query = "SELECT * FROM brands";
                                    $brand_query_run  = mysqli_query($con, $brand_query);

                                    if(mysqli_num_rows($brand_query_run) > 0)
                                    {
                                        foreach($brand_query_run as $brandlist)
                                        {
                                            $checked = [];
                                            if(isset($_GET['brands']))
                                            {
                                                $checked = $_GET['brands'];
                                            }
                                            ?>
                                                <div>
                                                    <input type="checkbox" name="brands[]" value="<?= $brandlist['brand_id']; ?>" 
                                                        <?php if(in_array($brandlist['brand_id'], $checked)){ echo "checked"; } ?>
                                                    />
                                                    <?= $brandlist['name']; ?>
                                                </div>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Brands Found";
                                    }
                                ?>
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </div>
                        </form>
                </div>
                    </div>
                </div>
                <?php
                            if(isset($_GET['brands']))
                            {
                                $branchecked = [];
                                $branchecked = $_GET['brands'];
                                foreach($branchecked as $rowbrand)
                                {
                                    // echo $rowbrand;
                                    $products = "SELECT * FROM mobil WHERE brand_id IN ($rowbrand)";
                                    $products_run = mysqli_query($con, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                        foreach($products_run as $proditems) :
                                            ?>
                                                <div class="col-sm-4">
                                            <div class="card">
                                            <a href="detail.php?id=<?php echo $proditems['id_mobil'];?>" class="detail"><img src="assets/image/<?= $proditems['gambar'];?>" class="card-img-top" style="height:200px;"></a>
                                            </div>
                                            <div class="info">
                                                <h5 class="card-title mt-2"><?= $proditems['merk'];?></h5>
                                                <p><i class="fa-sharp fa-solid fa-location-dot mr-2 mt-2"></i><?php echo ($isi['city']);?></p>
                                            </div>
                                            <p class="Price" style="font-weight: bolder;"> Rp. <?php echo number_format($proditems['harga']);?>/ hari</p>                                
                                        </div>
                                            <?php
                                        endforeach;
                                    }
                                }
                            }
                            else
                            {
                                $products = "SELECT * FROM mobil";
                                $products_run = mysqli_query($con, $products);
                                if(mysqli_num_rows($products_run) > 0)
                                {
                                    foreach($products_run as $proditems) :
                                        ?>
                                            <div class="col-sm-4">
                                            <div class="card">
                                            <a href="detail.php?id=<?php echo $isi['id_mobil'];?>" class="detail"><img src="assets/image/<?= $proditems['gambar'];?>" class="card-img-top" style="height:200px;"></a>
                                            </div>
                                            <div class="info">
                                                <h5 class="card-title mt-2"><?= $proditems['merk'];?></h5>
                                                <p><i class="fa-sharp fa-solid fa-location-dot mr-2 mt-2"></i><?php echo ($isi['city']);?></p>
                                            </div>
                                            <p><i class="Price"></i> Rp. <?php echo number_format($proditems['harga']);?>/ hari</p>
                                        </div>
                                        <?php
                                    endforeach;
                                }
                                else
                                {
                                    echo "No Items Found";
                                }
                            }
                        ?>
            </div>
        </div>
    </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="post" action="koneksi/proses.php?id=daftar">
                    <div class="form-group">
                    <label for="">Nama Pengguna</label>
                    <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="user" id="" class="form-control"  required placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="pass" id="" class="form-control" required placeholder="" aria-describedby="helpId">
                    </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary text-white" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>
