<?php
$title = 'Home';
require_once("includes/header.php");
include "db_conn.php";
?>

<main>
    <section>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="imgs/bg.jpg" class="bg-img" alt="Slide 1">
                    <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center">
                        <h1 class="fs-1 text-uppercase intro">Rent a Car with Ease</h1>
                        <p class="fs-5 intro">
                            Whether you're traveling for business, leisure, or just need a temporary vehicle,
                            we offer a wide range of cars to suit your needs. Our simple booking process,
                            affordable rates, and exceptional customer service make renting a car a hassle-free experience.
                        </p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="imgs/gtr.jpg" class="bg-img" alt="Slide 2">
                    <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center">
                        <h1 class="fs-1 text-uppercase intro">Rent a Car with Ease</h1>
                        <p class="fs-5 intro">
                            Whether you're traveling for business, leisure, or just need a temporary vehicle,
                            we offer a wide range of cars to suit your needs. Our simple booking process,
                            affordable rates, and exceptional customer service make renting a car a hassle-free experience.
                        </p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="imgs/gtr2.jpg" class="bg-img" alt="Slide 3">
                    <div class="carousel-caption text-white d-flex flex-column h-100 align-items-center justify-content-center">
                        <h1 class="fs-1 text-uppercase intro">Rent a Car with Ease</h1>
                        <p class="fs-5 intro">
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
        

        <div class="container text-dark mt-5">
            <div class="row">
                <center><h1> Most recent Cars </h1> </center>
                <?php
                if (isset($conn) && $conn) {
                    $sql = "SELECT * FROM cars ORDER BY id DESC LIMIT 3";
                    $stmt = mysqli_prepare($conn, $sql);

                    if ($stmt && mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = htmlspecialchars($row['id']);
                                $name = htmlspecialchars($row['name']);
                                $image = htmlspecialchars($row['image']);
                                $client_name = htmlspecialchars($row['client_name']);
                                $price = htmlspecialchars($row['price']);
                                $seats = htmlspecialchars($row['seats']);
                                $trans = htmlspecialchars($row['trans']);

                                echo '
                                <div class="col-md-4 col-sm-6 mb-4 mt-3">
                                    <div class="card border-0 shadow-sm hover-shadow h-100">
                                        <img src="' . str_replace('../', '', $image) . '" class="img-fluid rounded-start" alt="' . $name . '" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">' . $name . '</h5>
                                            <p class="text-muted mb-1">Rented by: <strong>' . $client_name . '</strong></p>
                                            <p class="mb-1">Price (Daily): <strong>' . $price . '</strong></p>
                                            <p class="mb-1">Seats: <strong>' . $seats . '</strong></p>
                                            <p class="mb-1">Transmission: <strong>' . $trans . '</strong></p>
                                            <a href="booking.php?bookingid=' . $id . '" class="btn btn-success text-white shadow-none mt-2">Book Now</a>
                                        </div>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo '<p class="text-center">No cars available at the moment.</p>';
                        }
                    } else {
                        echo '<p class="text-center text-danger">Failed to retrieve car data. Please try again later.</p>';
                    }
                } else {
                    echo '<p class="text-center text-danger">Database connection not available.</p>';
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php
require_once("includes/footer.php");
?>
