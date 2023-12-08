<!doctype html>
<html lang="en">
  <head>
    <title>Rental Mobil</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="header.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" >
    <link rel="stylesheet" href="assets/css/font-awesome.css" >
  </head>
  <body>
    <div class="jumbotron pt-4 pb-4" style="background-color: #59C1BD">
        <nav class="navbar navbar-expand-lg">
        <h2><b style="text-transform:uppercase;"><?= $info_web->nama_rental;?> </b></h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#"></a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="blog.php">Daftar Mobil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="kontak.php">Kontak Kami</a>
                </li>
            </ul>
            </div>
            <div class="search-bx">
                <form class="form-inline" method="get" action="blog.php">
                    <input class="form-control mr-sm-2" type="search" name="cari" placeholder="Search here..." aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><img src="./assets/image/search.png" alt="" width="20px"></button>
                </form>
            </div>
            <?php if($_SESSION['USER']){?>
            <div class="account">
                <?php }else{?>
                <a href="login.php"><button class="login-btn" style="border: none; background-color: #CFF5E7; margin-right: 10px; border-radius: 10px; width: 80px; height: 40px; cursor: pointer;">Login</button></a>
                <a href="signup.php"><button class="signup-btn" style="border: none; background-color: #CFF5E7; border-radius: 10px; width: 80px; height: 40px; cursor: pointer;">Signup</button></a>
                <?php }?>
            </div>
            <?php if(!empty($_SESSION['USER'])){?>
            <div class="greet">
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-user"> </i> Hallo, <?php echo $_SESSION['USER']['nama_pengguna'];?>
                    </a>
                </li>
            </ul>
            </div>
            <?php }?>
            <?php if(!empty($_SESSION['USER'])){?>
            <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php if(!empty($_SESSION['USER'])){?>
                            <a class="dropdown-item" href="profil.php">Profil</a>
                            <a class="dropdown-item" href="history.php">History</a>
                            <a class="dropdown-item" onclick="return confirm('Apakah anda ingin logout ?');" href="./admin/logout.php">Logout</a>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    <div style="margin-top:-2pc"></div>
        </div>
    </nav>