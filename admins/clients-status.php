<?php
$title = "User Info";
require_once("includes/headerAdmins.php");
include "../db_conn.php";

if (isset($_GET['infoid'])) {
    $id = str_replace('_', ' ', $_GET['infoid']);
} else {
    echo "No booking ID provided.";
    exit();
}

?>

<main class="mt-5 pt-3">
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center my-3">Client Info</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Clientname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">IC/Passport No</th>
                            <th scope="col">Driver License No</th>
                            <th scope="col">Bank Acc NO</th>
                            <th scope="col">Bank Type</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM clients WHERE id='$id'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            if ($row = mysqli_fetch_assoc($result)) {
                                $name = $row['full_name'];
                                $email = $row['email'];
                                $phonenum = $row['phone_num'];
                                $clientname = $row['client_name'];
                                $ic_no = $row['ic_no'];
                                $driver_no = $row['driver_no'];
                                $driver_img = $row['driver_img'];
                                $bank_no = $row['bank_no'];
                                $bank_type = $row['bank_type'];
                                $status = $row['status'];

                                echo '<tr>
                                    <td>' . $id . '</td>
                                    <td>' . $clientname . '</td>
                                    <td>' . $email . '</td>
                                    <td>' . $name . '</td>
                                    <td>' . $phonenum . '</td>
                                    <td>' . $ic_no . '</td>
                                    <td>' . $driver_no . '</td>
                                    <td>' . $bank_no . '</td>
                                    <td>' . $bank_type . '</td>
                                    <td>' . $status . '</td>
                                </tr>';

                                echo '<tr>
                                    <td colspan="10" class="text-center">
                                        <form method="POST" action="clients-approve.php">
                                            <input type="hidden" name="id" value="' . $id . '">
                                            <button type="submit" name="action" value="verified" class="btn btn-success">Approve</button>
                                            <button type="submit" name="action" value="rejected" class="btn btn-danger">Reject</button>
                                        </form>
                                    </td>
                                </tr>';

                                echo '</tbody></table>'; 

                                
                                echo '<div class="text-center mt-4">
                                        <h4>Driver License Image</h4>
                                        <img src="' . $driver_img . '" alt="Driver License Image" style="max-width: 500px; height: auto; border: 1px solid #ddd; padding: 5px;"/>
                                      </div>';
                            } else {
                                echo '<tr><td colspan="10" class="text-center">No booking found with this ID.</td></tr>';
                            }
                        } else {
                            echo '<tr><td colspan="10" class="text-center">Error fetching booking details: ' . mysqli_error($conn) . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
