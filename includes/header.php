<?php 
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link href="includes/css/stylesheet.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Car Rental - <?php echo $title ?> </title>
</head>

<body>
    
    <!--- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top intro">
        <div class="container">
            <a class="navbar-brand fs-4 fw-bold text-uppercase" href="index.php">Car Rental</a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas navbar-dark bg-dark offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header text-white border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Car Rental</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link <?php echo $current_page == 'cars.php' ? 'active' : ''; ?>" href="cars.php">Cars</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link <?php echo $current_page == 'about.php' ? 'active' : ''; ?>" href="about.php">About</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link <?php echo $current_page == 'contact.php' ? 'active' : ''; ?>" href="contact.php">Contact</a>
                        </li>
                    </ul>
                    <div class="d-flex flex-lg-row justify-content-center align-item-center gap-3">
                    <a href="login.php" class="text-white text-decoration-none" >Login</a>
                    <a href="signup.php" class="text-white text-decoration-none px-3 py-1 rounded-4 d-inline-block" style="background-color:#f94ca4 ;" >Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--- Navbar -->

    <script>
        const navEl= document.querySelector('.navbar');

        window.addEventListener('scroll', () => {
            if(window.scrollY >= 56){
                navEl.classList.add('navbar-scrolled')
            }  else if (window.scrollY < 56) {
                navEl.classList.remove('navbar-scrolled')
            }
        });
    </script>

</body>