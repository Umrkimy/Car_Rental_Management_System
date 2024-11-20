<?php
$title = 'Home';
require_once("includes/headerClients.php");
?>

<main>
    <section>

        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="4000">
                        <img src="imgs/bg.jpg" class="bg-img" alt="...">
                        <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center bottom-0 ">
                            <h1 class="fs-1 text-uppercase intro">Rent a Car with Ease</h1>
                            <p class="p-1 fs-5 intro">
                                Whether you're traveling for business, leisure, or just need a temporary vehicle,
                                we offer a wide range of cars to suit your needs. Our simple booking process,
                                affordable rates, and exceptional customer service make renting a car a hassle-free experience.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <img src="imgs/gtr.jpg" class="bg-img" alt="...">
                        <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center bottom-0 ">
                            <h1 class="fs-1 text-uppercase intro">Rent a Car with Ease</h1>
                            <p class="p-1 fs-5 intro">
                                Whether you're traveling for business, leisure, or just need a temporary vehicle,
                                we offer a wide range of cars to suit your needs. Our simple booking process,
                                affordable rates, and exceptional customer service make renting a car a hassle-free experience.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="imgs/bg.jpg" class="bg-img" alt="...">
                        <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center bottom-0 ">
                            <h1 class="fs-1 text-uppercase intro">Rent a Car with Ease</h1>
                            <p class="p-1 fs-5 intro">
                                Whether you're traveling for business, leisure, or just need a temporary vehicle,
                                we offer a wide range of cars to suit your needs. Our simple booking process,
                                affordable rates, and exceptional customer service make renting a car a hassle-free experience.
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

    </section>
</main>
