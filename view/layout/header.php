<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--bootstrap core item-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/mycss.css" rel="stylesheet"> 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <?php
            if(isset($_GET['profil'])){
                $linkhome = 'index.php';
                $linkproduk = 'index.php#produk';
                $linkkategori = 'index.php#kategori';
            }
            else{
                $linkhome = '#top';
                $linkproduk = '#produk';
                $linkkategori = '#kategori';
            }
        ?>

        <!--Navigation Bar-->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">BadjoeKoe</a>
            </div>
            
            <ul class="nav navbar-top-links navbar-right">
                <?php if(!isset($_GET['profil']) && !isset($_GET['databaju']) && !isset($_GET['kategori'])) : ?>
                    <li>
                        <a href="<?= $linkproduk ?>">Produk</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?= $linkkategori ?>">Kategori</a>
                    </li>
                <?php endif; ?>

                <?php if(!isset($_SESSION['id'])) : ?>
                    <li class="page-scroll">
                        <a href="index.php?login">Login</a>
                    </li>
                <?php elseif(isset($_SESSION['id'])) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  
                            <?= $_SESSION['username']; ?>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <?php if($_SESSION['level'] == '1') : ?>
                                <li><a href="?databaju"><i class="fa fa-database fa-fw"></i>Lihat Data Barang</a></li>
                                <li class="divider"></li>
                            <?php endif; ?>
                            <li><a href="?profil"><i class="fa fa-user fa-fw"></i> My Profile</a>
                            <li class="divider"></li>
                            <li><a href="action/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>

            <?php if(isset($_GET['profil']) || isset($_GET['databaju']) || isset($_GET['kategori'])) : ?>
                <div class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav" id="side-menu">
                            <li><a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Home</a></li>

                            <?php if($_SESSION['level'] == '1') : ?>
                                <li><a href="?databaju"><i class="fa fa-database fa-fw"></i>Data Baju</a></li>
                                <li><a href="?kategori"><i class="fa fa-tags fa-fw"></i>Kategori</a></li>
                            <?php endif; ?>

                            <li><a href="action/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </nav>
        <!--End of Navigation-->