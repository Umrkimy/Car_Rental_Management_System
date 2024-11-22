<?php
$title = "Admin Home";
require_once("includes/headerAdmins.php");
include "../db_conn.php"
?>

<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4>Dashboard</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
          <div class="card-body py-5">Primary Card</div>
          <div class="card-footer d-flex">
            View Details
            <span class="ms-auto">
              <i class="bi bi-chevron-right"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-warning text-dark h-100">
          <div class="card-body py-5">Warning Card</div>
          <div class="card-footer d-flex">
            View Details
            <span class="ms-auto">
              <i class="bi bi-chevron-right"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100">
          <div class="card-body py-5">Success Card</div>
          <div class="card-footer d-flex">
            View Details
            <span class="ms-auto">
              <i class="bi bi-chevron-right"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white h-100">
          <div class="card-body py-5">Danger Card</div>
          <div class="card-footer d-flex">
            View Details
            <span class="ms-auto">
              <i class="bi bi-chevron-right"></i>
            </span>
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
                                               <center> <a href="users-approve.php?updateid=' . $id . '" class=""><i class="bi bi-three-dots text-secondary"></i></a> </center>
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
                    <th scope="col">Client  name</th>
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
                                               <center> <a href="users-approve.php?updateid=' . $id . '" class=""><i class="bi bi-three-dots text-secondary"></i></a> </center>
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
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card">
          <div class="card-header">
            <span><i class="bi bi-table me-2"></i></span> Data Table
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                id="example"
                class="table table-striped data-table"
                style="width: 100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                  </tr>
                </thead>
                <tbody>
                  <td>Donna Snider</td>
                  <td>Customer Support</td>
                  <td>New York</td>
                  <td>27</td>
                  <td>2011/01/25</td>
                  <td>$112,000</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>