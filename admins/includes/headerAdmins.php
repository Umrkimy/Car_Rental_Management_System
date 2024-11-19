<!DOCTYPE html>

<head >

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
session_start();

if (isset($_SESSION['id']) && ($_SESSION['admin_name'])) {
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="includes/customstylesheet.css" rel="stylesheet" />    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
        <title>Car Rental - <?php echo $title ?> </title>
</head>

<body>
        <div id="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="adminHomepage.php">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

                <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active fw-bold fs-6">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item active fw-bold fs-6">
                            <a class="nav-link" href="bookingAdmin.php">Booked</a>
                        </li>
                        <li class="nav-item active fw-bold fs-6">
                            <a class="nav-link" href="usersManage.php">Users</a>
                        </li>
                        <li class="nav-item active fw-bold fs-6">
                            <a class="nav-link" href="roomsAdmin.php">Cars</a>
                        </li>
                        <li class="nav-item active fw-bold fs-6">
                            <a class="nav-link" href="roomsCategory.php">Cars Category</a>
                        </li>
                    </ul>
                </div>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active fw-bold fs-6">
                            <a class="nav-link" href="index.php">Logout</a>
                        </li>
                        <li class="nav-item active fw-bold fs-6">
                            <a class="nav-link" style="color:whitesmoke">Hello <?php echo $_SESSION['admin_name']; ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

    <?php
} else {
    header("Location: homepage.php");
    exit();
}
    ?>