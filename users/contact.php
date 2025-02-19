<?php
$title = 'Contact';
require_once("includes/headerUsers.php");
?>

<main>

    <body>

        <div>
            <div style="position: relative;">
                <img src="../imgs/bg3.jpg" class="bg-img3 w-100" alt="Background image">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters align-items-end justify-content-start">
                        <div class="col-md-9 ftco-animate pb-5 text-overlay">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb fs-10 fw-bold text-uppercase">
                                    <div class="mr-5">
                                        <a href="index.php" class="text-decoration-none home-link">Home
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </div>
                                    <a class="text-decoration-none text-light">Contact
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </ol>
                            </nav>
                            <h1 class="fst-italic text-capitalize text-white">Contact</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="ftco-section contact-section text-dark mt-5 pt-3">
            <div class="container">
                <div class="row d-flex mb-5 contact-info">
                    <div class="col-md-4">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="border w-100 p-4 rounded mb-2 d-flex">
                                    <div class="icon mr-3">
                                        <span class="icon-map-o"></span>
                                    </div>
                                    <p><span>Address:</span> 1016, Jln Sultan Ismail, Bandar Wawasan, 50250 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="border w-100 p-4 rounded mb-2 d-flex">
                                    <div class="icon mr-3">
                                        <span class="icon-mobile-phone"></span>
                                    </div>
                                    <p><span>Phone:</span> <a href="tel://01161310512">+60 1161310512</a></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="border w-100 p-4 rounded mb-2 d-flex">
                                    <div class="icon mr-3">
                                        <span class="icon-envelope-o"></span>
                                    </div>
                                    <p><span>Email:</span> <a href="mailto:info@yoursite.com">Carrental@gmail.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 block-9 mb-md-5">
                        <form action="../email-support.php" method="POST" class="bg-light p-5 contact-form">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group mb-3">
                                <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
                            </div>
                            <div class="form-group ">
                                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>

                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div id="map" class="bg-white"></div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</main>

<?php require_once("includes/footerUsers.php"); ?>