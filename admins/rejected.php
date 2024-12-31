<?php
$title = "Rejected";
require_once("includes/headerAdmins.php");
include "../db_conn.php";
?>

<main class="mt-5 pt-3">
    <div class="container mt-3 gap">
        <div class="row justify-content-center">
            <div class="col-md-13 mb-4">
                <div class="card ">
                    <div class="card-header">
                        <h2 class="card-title">Rejected Clients</h2>
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
                          $sql = "SELECT * FROM clients WHERE status = 'Rejected' ORDER BY id DESC LIMIT 3";
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
</main>
