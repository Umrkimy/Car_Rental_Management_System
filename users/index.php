<?php
$title = 'Home';
require_once("includes/headerUsers.php");
include "../db_conn.php";

$user_count_sql = "SELECT COUNT(*) AS user_count FROM users";
$user_count_result = mysqli_query($conn, $user_count_sql);
$user_count = 0;
if ($user_count_result) {
    $row = mysqli_fetch_assoc($user_count_result);
    $user_count = $row['user_count'];
}

$client_count_sql = "SELECT COUNT(*) AS client_count FROM clients";
$client_count_result = mysqli_query($conn, $client_count_sql);
$client_count = 0;
if ($client_count_result) {
    $row = mysqli_fetch_assoc($client_count_result);
    $client_count = $row['client_count'];
}

$car_count_sql = "SELECT COUNT(*) AS car_count FROM cars";
$car_count_result = mysqli_query($conn, $car_count_sql);
$car_count = 0;
if ($car_count_result) {
    $row = mysqli_fetch_assoc($car_count_result);
    $car_count = $row['car_count'];
}
?>

<main>
    <section class="bg-light">

        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                        <img src="../imgs/bg.jpg" class="bg-img" alt="...">
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
                        <img src="../imgs/gtr.jpg" class="bg-img" alt="...">
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
                        <img src="../imgs/gtr2.jpg" class="bg-img" alt="...">
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

            <div class="container text-dark mt-5">
                <div class="row">
                    <center>
                        <h1 class="fs-1 text-uppercase  ">Most Recent Car</h1>
                    </center>
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
                                <div class="col-md-4 col-sm-6 mb-5 mt-3 intro">
                                    <div class="card border-0 shadow-sm hover-shadow h-100">
                                        <img src="' . $image . '" class="img-fluid rounded-start" alt="' . $name . '" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">' . $name . '</h5>
                                            <p class="text-muted mb-1">Renter: <a href="profile_client.php?clientname=' . htmlspecialchars($row['client_name']) . '"> <strong>' . htmlspecialchars($row['client_name']) . '</strong></a> </p>
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

    <section class="text-dark bg-light">

        <link href="includes/css/counter.css" rel="stylesheet" />

        <div class="counter-wrapper">
            <div class="counter">
                <h1 class="count" data-target="<?php echo $user_count; ?>">0</h1>
                <p>Happy Users</p>
            </div>
            <div class="counter">
                <h1 class="count" data-target="<?php echo $client_count; ?>">0</h1>
                <p>Happy Clients</p>
            </div>
            <div class="counter">
                <h1 class="count" data-target="<?php echo $car_count; ?>">0</h1>
                <p>Total Cars</p>
            </div>
        </div>

        <script src="includes/js/counter.js"></script>

    </section>

</main>

<?php
require_once("includes/footerUsers.php");
?>