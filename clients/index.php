<?php
$title = 'Home';
require_once("includes/headerClients.php");
?>

<main>
    <body>
        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="../imgs/bg2.jpg" class="bg-img" alt="Slide 1">
                    <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center">
                        <h1 class="fs-1 text-uppercase intro">Rent Out Your Car with Confidence</h1>
                        <p class="fs-5 intro">
                        Turn your vehicle into a money-making asset! Whether you have an extra car or want to earn during its downtime, we make renting out your car simple and secure. With our user-friendly platform, competitive rates, and dedicated support, you can confidently share your vehicle and maximize your earnings.
                        </p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="../imgs/bg3.jpg" class="bg-img" alt="Slide 2">
                    <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center">
                        <h1 class="fs-1 text-uppercase intro">Rent Out Your Car with Confidence</h1>
                        <p class="fs-5 intro">
                        Turn your vehicle into a money-making asset! Whether you have an extra car or want to earn during its downtime, we make renting out your car simple and secure. With our user-friendly platform, competitive rates, and dedicated support, you can confidently share your vehicle and maximize your earnings.
                        </p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="../imgs/gtr2.jpg" class="bg-img" alt="Slide 3">
                    <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center">
                        <h1 class="fs-1 text-uppercase intro">Rent Out Your Car with Confidence</h1>
                        <p class="fs-5 intro">
                        Turn your vehicle into a money-making asset! Whether you have an extra car or want to earn during its downtime, we make renting out your car simple and secure. With our user-friendly platform, competitive rates, and dedicated support, you can confidently share your vehicle and maximize your earnings.
                        </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
            <!-- Carousel -->

            <section class="ftco-section ftco-about my-5">
    <div class="container">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="about-image" style="
                    background-image: url('../imgs/bg2.jpg');
                    background-size: cover;
                    background-position: center;
                    height: 100%;
                    min-height: 400px;">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="content-wrapper p-4">
                    
                    <span class="subheading text-secondary fw-bold">About Us</span>
                    
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
                    <a href="#" class="btn btn-primary px-5 py-3 mt-3">Explore Vehicles</a>
                </div>
            </div>
        </div>
    </div>
</section>

            </body>
</main>

<?php
require_once("includes/footerClients.php");
?>