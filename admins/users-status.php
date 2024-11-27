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
            <h1 class="text-center my-3">User info</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>

                            <th scope="col">Email</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM users WHERE id='$id'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            if ($row = mysqli_fetch_assoc($result)) {
                                $name = $row['full_name'];
                                $email = $row['email'];
                                $phonenum = $row['phone_num'];
                                $username = $row['user_name'];
                                $status = $row['status'];
                                $date = $row['date'];
                                $password = $row['password'];

                                echo '<tr>
                                    <td>' . $id . '</td>
                                    <td>' . $username . '</td>
                                    <td>' . $email . '</td>
                                    <td>' . $name . '</td>
                                    <td>' . $phonenum . '</td>
                                    <td>' . $status . '</td>
                                    <td>' . $date . '</td>
                                    <td>' . $password . '</td>
                                </tr>';

                                echo '<tr>
                                    <td colspan="8" class="text-center">
                                        <form method="POST" action="users-approve.php">
                                            <input type="hidden" name="id" value="' . $id . '">
                                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                                            <button type="submit" name="action" value="disapprove" class="btn btn-danger">Disapprove</button>
                                        </form>
                                    </td>
                                </tr>';

                            } else {
                                echo '<tr><td colspan="11" class="text-center">No booking found with this ID.</td></tr>';
                            }
                        } else {
                            echo '<tr><td colspan="11" class="text-center">Error fetching booking details: ' . mysqli_error($conn) . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>

