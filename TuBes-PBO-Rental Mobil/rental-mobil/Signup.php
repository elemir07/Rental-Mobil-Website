<?php
require 'koneksi/koneksi.php';
if(empty($_SESSION['USER']))
{
    session_start();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Rental Mobil</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="signup.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" >
    <link rel="stylesheet" href="assets/css/font-awesome.css" >
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="image col-6">
                <img src="./assets/image/login.png" alt="">
            </div>
            <div class="container-border col-6">
                <form method="post" action="koneksi/proses.php?id=daftar">
                    <div class="form-group">
                        <center><h5 class="card-title">Signup</h5></center>
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
                        <div class="button-action">
                        <a class="btn btn-secondary text-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
