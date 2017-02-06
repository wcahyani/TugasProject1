        <!-- Ini halaman pertamanya -->

        <?php
            spl_autoload_register(function ($class)
            {
                if (file_exists('model/'. $class .'.php'))
                    require 'model/'. $class . '.php';
                else
                    exit('Tidak dapat membuka class '.$class.'!');
            });

            require 'config/config.php';
        ?>
        
        <!--Header-->
        <header class="header bg-primary">
           <div class="carousel-caption">
                        <h1 class="light mab-none text-left">Selamat Datang <strong class="bold-text">@BadjoeKoe</strong></h1>
                        <h1 class="light margin-bottom-medium mat-none text-left">Wujudkan Gayamu <strong class="bold-text">@BadjoeKoe</strong></h1>
                        <div class="call-button">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12">
                                    <a href="#portfolio" class="button pull-right internal-link bold-text light hvr-grow" data-rel="#portfolio">Our Work</a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <a href="#about-us" class="button pull-left internal-link bold-text main-bg hvr-grow" data-rel="#about-us">About Us</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                <div class="overlay"></div>
        <div id="carouselku" class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#carouselku" data-slide-to="0" class="active"></li>
                <li data-target="#carouselku" data-slide-to="1"></li>
                <li data-target="#carouselku" data-slide-to="2"></li>
            </ol> 
            <div class="carousel-inner"  style="height:650px" >
                <div class="item active">
                    <img src="http://www.leafit.com.pl/wp-content/uploads/2014/07/a6000w1907v_Venus_w1907v_blue_opt_15in1_L.jpg" alt="Gambar 1">
                </div>
                <div class="item">
                    <img src="https://computeram.files.wordpress.com/2011/08/inprsout.jpg" alt="Gambar 2">
                </div>
                <div class="item">
                    <img src="https://cdn-ds.kilatstorage.com/wp-content/uploads/2015/09/shutterstock_222211744.jpg" alt="Gambar 3">
                </div>
            </div>
            <a class="carousel-control left" href="#carouselku" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#carouselku" data-slide="next">&rsaquo;</a>
        </div>
    </header>

        <!--End of Header-->
        <!--Body-->
        <!--Section Produk-->
         <section id="produk" style="padding-top:50px">
    <div class="container">
        <div class="row">
              <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Produk Kita</h1>
            </div>

            <?php
                $stmt = $con->select('tabel_product');
                $stmt->execute();

                while($row = $stmt->fetch(PDO::FETCH_OBJ)) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive foto-produk" src="images/produk/<?= $row->foto_produk ?>" alt="">
                        </a>
                        <div class="caption">
                        <h5><?= $row->nama_produk ?></h5>
                        <p><?= $row->ket_produk ?></p>
                        <p align="center"><a href="#" class="btn btn-primary btn-block">Open</a></p>
                        </div>
                    </div>
            <?php endwhile; ?>

        </div>

        <hr>
            </div></div>
</div>
        </section>
        <!--End of Section Produk-->

        <!--Section Kategori-->
         <!--<section id="kategori">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Kategori</h2>
                </div>
            </div>
            </div>
        </section>-->
        <!--End of Section Kategori-->
           <!--Section Kategori-->
         <!--<section id="registrasi">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Registrasi</h2>
                </div>
            </div>
            </div>
        </section>-->
        <!--End of Section Kategori-->
        <!--End of Body-->
        <!--Footer-->
        
