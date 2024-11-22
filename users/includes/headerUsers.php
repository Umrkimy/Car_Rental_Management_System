<!DOCTYPE html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="includes/users.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Car Rental - <?php echo $title ?> </title>
</head>

<body class="vh-100 ">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
        <div class="container">
            <a class="navbar-brand fs-4 fw-bold text-uppercase" href="#">Car Rental</a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas offcanvas-start navbar-dark bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header text-white border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Car Rental</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                    <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Cars</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Cars</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle ms-2"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-fill" style=" width: 22px; font-size: 22px;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <script>
        const navEl = document.querySelector('.navbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY >= 56) {
                navEl.classList.add('navbar-scrolled')
            } else if (window.scrollY < 56) {
                navEl.classList.remove('navbar-scrolled')
            }
        });
    </script>

</body>