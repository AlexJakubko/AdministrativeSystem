<?php
include 'views/partials/header.php';
?>
<section class="fdb-block">
    <div class="container">
        <div class="row align-items-top">
            <div class="col-12 col-md-6 col-xl-4 m-auto">
                <h2>Informačný systém ubytovania</h2>
            </div>

            <div class="col-12 col-md-6 pt-5 pt-md-0">
                <div class="row justify-content-left">
                    <div class="col-3 m-auto text-center">
                        <a href="/Jakubko/public_html/views/source/roomadmin.php">
                            <img alt="image" class="fdb-icon" src="./imgs/icons/monitor.svg">
                            <p><i class="fas"></i>
                                Administrácia izieb</p>
                        </a>
                    </div>
                    <div class="col-3 m-auto text-center">
                        <a href="/Jakubko/public_html/views/source/studentadmin.php">
                            <img alt="image" class="fdb-icon" src="./imgs/icons/map.svg">
                            <p>Administrácia študentov<i class="fas"></i>
                        </a>
                        </p>
                    </div>
                    <div class="col-3 m-auto text-center">
                        <a href="/Jakubko/public_html/views/source/checking.php">
                            <img alt="image" class="fdb-icon" src="./imgs/icons/cloud.svg">
                            <p>Zápis<i class="fas "></i></p>
                        </a>
                    </div>
                </div>

                <div class="row justify-content-left mt-4 mt-xl-5">
                    <div class="col-3 m-auto text-center">
                        <a href="/Jakubko/public_html/views/source/studentlist.php">
                            <img alt="image" class="fdb-icon" src="./imgs/icons/layers.svg">
                            <p>
                                Zoznam študentov<i class="fas "></i>
                            </p>
                        </a>
                    </div>
                    <div class="col-3 m-auto text-center">
                        <a href="/Jakubko/public_html/views/source/roomlist.php">
                            <img alt="image" class="fdb-icon" src="./imgs/icons/map-pin.svg">
                            <p>Zoznam Izieb<i class="fas"></i>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include 'views/partials/footer.php';
?>