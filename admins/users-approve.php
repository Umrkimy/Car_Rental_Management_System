<?php
$title = "User Manage";
require_once("includes/headerAdmins.php");
include "../db_conn.php";
?>

<main class="mt-5 pt-3">

<div class="container mt-5 gap">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-4">
            <div class="card ">
                <div class="card-header">
                    <h2 class="card-title">Users</h2>
                </div>
                <div class="card-body">
                    <div class="container mb-3">
                        <a href="users-add.php" class="btn btn-primary">Add User</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM users";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $name = $row['full_name'];
                                        $user_name = $row['user_name'];
                                        $phonenum = $row['phone_num'];
                                        $email = $row['email'];
                                        $address = $row['address'];
                                        $password = $row['password'];

                                        echo '<tr>
                                            <td>' . $id . '</td>
                                            <td>' . $name . '</td>
                                            <td>' . $user_name . '</td>
                                            <td>' . $phonenum . '</td>
                                            <td>' . $email . '</td>
                                            <td>' . $address . '</td>
                                            <td>' . $password . '</td>
                                            <td>
                                                <a href="users-update.php?updateid=' . $id . '" class=""><i class="bi bi-check-circle-fill text-success"></i></a>
                                                <a href="users-delete.php?deleteid=' . $id . '" class=" mt-1"><i class="bi bi-x-circle-fill"></i></a>
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
</div>
    </main>