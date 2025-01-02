<?php
$title = "Admin Home";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

$message = "";


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

  $rejected_count_sql = "SELECT COUNT(*) AS rejected_count FROM clients WHERE status = 'rejected'";
  $rejected_count_result = mysqli_query($conn, $rejected_count_sql);
  $rejected_count = 0;

  if ($rejected_count_result) {
    $row = mysqli_fetch_assoc($rejected_count_result);
    $rejected_count = $row['rejected_count'];
  }
}


?>

<main class="mt-5 pt-3">

  <head>
    <link href="includes/css/card.css" rel="stylesheet" />
  </head>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4>Dashboard</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
          <div class="card-body py-5">
            <h5>User Count</h5>
            <p class="fs-2"><?php echo $user_count; ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100">
          <div class="card-body py-5">
            <h5>Client Count</h5>
            <p class="fs-2"><?php echo $client_count; ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-3">
        <div class="card bg-info text-white h-100">
          <div class="card-body py-5">
            <h5>Car Count</h5>
            <p class="fs-2"><?php echo $car_count; ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white h-100">
          <div class="card-body py-5">
            <h5>Rejected Clients count</h5>
            <p class="fs-2"><?php echo $rejected_count; ?></p>
          </div>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card h-100">
          <div class="card-header">
            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
            Users New Account
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Operations</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 3";
                  $result = mysqli_query($conn, $sql);
                  if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id = $row['id'];
                      $user_name = $row['user_name'];
                      $email = $row['email'];

                      echo '<tr>
                            <td>' . $id . '</td>
                            <td>' . $user_name . '</td>
                            <td>' . $email . '</td>
                         <td >
                          <center> <a href="users-info.php?infoid=' . $id . '" class=""><i class="bi text-secondary bi-eye-fill"></i></a> </center>
                     </td>
                    </tr>';
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card h-100">
          <div class="card-header">
            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
            Clients New Account
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Client name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Operations</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM clients ORDER BY id DESC LIMIT 3";
                  $result = mysqli_query($conn, $sql);
                  if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id = $row['id'];
                      $client_name = $row['client_name'];
                      $email = $row['email'];

                      echo '<tr>
                       <td>' . $id . '</td>
                      <td>' . $client_name . '</td>
                    <td>' . $email . '</td>
                    <td >
             <center> <a href="clients-info.php?infoid=' . $id . '" class=""><i class="bi text-secondary bi-eye-fill"></i></a> </center>
                  </td>
                     </tr>';
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="mb-3">
      <div class="card h-100">
        <div class="card-header">
          <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
          Pending Clients
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Clientname</th>
                  <th scope="col">Email</th>
                  <th scope="col">Status</th>
                  <th scope="col">Operations</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM clients WHERE status = 'Pending' ORDER BY id DESC LIMIT 3";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $client_name = $row['client_name'];
                    $email = $row['email'];
                    $status = $row['status'];

                    echo '<tr>
                          <td>' . $id . '</td>
                          <td>' . $client_name . '</td>
                          <td>' . $email . '</td>
                          <td>' . $status . '</td>
                          <td>
                            <center>
                              <a href="clients-status.php?infoid=' . $id . '" class=""><i class="bi text-secondary bi-eye-fill"></i></a>
                            </center>
                          </td>
                        </tr>';
                  }
                } else {
                  echo '<tr><td colspan="5" class="text-center">No pending clients found.</td></tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</main>