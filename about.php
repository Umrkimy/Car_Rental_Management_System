<?php
$title = "About Us";
require_once("includes/header.php");
?>

<main>
<body>
    <div>
        <div style="position: relative;">
            <img src="imgs/bg2.jpg" class="bg-img2 w-100" alt="Background image">
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
                                <a class="text-decoration-none text-light">About us 
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                            </ol>
                        </nav>
                        <h1 class="fst-italic text-capitalize text-white">About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

<section class="ftco-section ftco-about my-5">
    <div class="container">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="about-image" style="
                    background-image: url('imgs/bg2.jpg');
                    background-size: cover;
                    background-position: center;
                    height: 100%;
                    min-height: 400px;">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="content-wrapper p-4">
                    
                    <span class="subheading text-light fw-bold text-uppercase ">About Us</span>
                    
                    <h2 class="mb-4 text-dark fw-bold">Welcome to Car Rental</h2>
                    <p class="text-muted">
                        Nestled in a serene environment, Car Rental is where stories of effortless journeys begin. 
                        A small river named Duden flows by, creating a picturesque, inspiring backdrop for a journey 
                        that promises comfort and style.
                    </p>
                    <p class="text-muted">
                        Here, your experience is our priority. We combine the charm of a classic narrative with the precision 
                        of modern innovation. Whether you're exploring new destinations or simply seeking convenience, 
                        Carbook is your companion for every journey.
                    </p>
                    <a href="cars.php" class="btn btn-primary px-5 py-3 mt-3">Explore Vehicles</a>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</main>

<?php require_once("includes/footer.php"); ?>

