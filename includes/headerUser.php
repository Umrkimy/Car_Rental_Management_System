<!DOCTYPE html>

<head >

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="css/customstylesheet.css" rel="stylesheet" />    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
        <title>Car Rental - <?php echo $title ?> </title>
</head>

<body>
    <div id="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand me-3 fw-bold fs-3 h-font" href="index.php">
                <img src="imgs/logo.jpg" width="30" height="30" />
                Car Rental
            </a>

            <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active me-2 fw-bold fs-6">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active me-2 fw-bold fs-6">
                        <a class="nav-link" href="aboutUs.php">About Us</a>
                    </li>
                    <li class="nav-item active me-2 fw-bold fs-6">
                        <a class="nav-link" href="feedback.php">Feedback</a>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active fw-bold fs-6">
                        <a class="nav-link" href="userLogin.php">Login</a>
                       <!-- <a class="nav-link" href="homepage.php">Logout</a>-->
                    </li>


                </ul>
            </div>
        </nav>
    </div>
</body>