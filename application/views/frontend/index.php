<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url(); ?>assets/landing/img/favicon.png" rel="icon">
    <link href="<?= base_url(); ?>assets/landing/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>assets/landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/landing/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/landing/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/landing/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/landing/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/landing/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>assets/landing/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Logis
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="<?= base_url(); ?>assets/landing/img/logo.png" alt=""> -->
                <h1>PDAM</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#pricing">Informasi</a></li>
                    <li><a class="get-a-quote" href="<?= base_url('auth'); ?>">Login</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="home" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h2 data-aos="fade-up">Cek Penggunaan AIR jadi lebih mudah</h2>
                    <!-- <p data-aos="fade-up" data-aos-delay="100">Facere distinctio molestiae nisi fugit tenetur repellat non praesentium nesciunt optio quis sit odio nemo quisquam. eius quos reiciendis eum vel eum voluptatem eum maiores eaque id optio ullam occaecati odio est possimus vel reprehenderit</p> -->

                    <form action="<?= base_url('frontend'); ?>" method="post" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                        <input type="text" class="form-control" name="key" placeholder="Input ID pelanggan">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>

                    <?php if ($pelanggan) : ?>
                        <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-white">
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama</th>
                                            <th>Bulan</th>
                                            <th>Total Kubik</th>
                                            <th>Total Biaya</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-white">
                                        <?php $i = 1;
                                        foreach ($pelanggan as $dt) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i++; ?></td>
                                                <td><?= $dt->pelanggan_id; ?></td>
                                                <td><?= $dt->nama; ?></td>
                                                <td><?= date('M Y', strtotime($dt->tanggal)); ?></td>
                                                <td><?= $dt->kubik; ?></td>
                                                <td>Rp. <?= number_format($dt->totalBiaya); ?></td>
                                                <td>
                                                    <a href="<?= base_url('frontend/cetak/' . $dt->id); ?>" class="btn btn-primary" target="_blank">Cetak</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="<?= base_url(); ?>assets/landing/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0" alt="">
                </div>

            </div>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing pt-0">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <span>Informasi</span>
                    <h2>Informasi</h2>

                </div>

                <?php foreach ($informasi as $data) : ?>
                    <div class="row gy-4">

                        <div class="col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="pricing-item featured">
                                <h3><?= $data->perihal; ?></h3>
                                <p><?= $data->konten; ?></p>
                            </div>
                        </div><!-- End Pricing Item -->

                    </div>
                <?php endforeach; ?>

            </div>
        </section><!-- End Pricing Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="container mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>PDAM</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
            </div>
        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/landing/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url(); ?>assets/landing/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url(); ?>assets/landing/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/landing/vendor/aos/aos.js"></script>
    <script src="<?= base_url(); ?>assets/landing/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>assets/landing/js/main.js"></script>

</body>

</html>