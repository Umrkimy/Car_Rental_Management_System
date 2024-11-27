<?php
$title = "User Manage";
require_once("includes/headerAdmins.php");
include "../db_conn.php";
?>

<main class="mt-5 pt-3">

    <div class="container mt-3 gap">
        <div class="row justify-content-center">
            <div class="col-md-13 mb-4">
                <div class="card ">
                    <div class="card-header">
                        <h2 class="card-title">Clients</h2>
                    </div>
                    <div class="card-body">
                        <div class="container mb-3">
                            <a href="clients-add.php" class="btn btn-dark">Add Client</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Clientname</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM clients";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $name = $row['full_name'];
                                            $client_name = $row['client_name'];
                                            $phonenum = $row['phone_num'];
                                            $email = $row['email'];
                                            $status = $row['status'];


                                            echo '<tr>
                                            <td>' . $id . '</td>
                                            <td>' . $name . '</td>
                                            <td>' . $client_name . '</td>
                                            <td>' . $phonenum . '</td>
                                            <td>' . $email . '</td>
                                            <td>' . $status . '</td>

                                            <td>
                                            <a href="clients-info.php?infoid=' . $id . '" class="btn btn-success">View</a>
                                                <a href="clients-update.php?updateid=' . $id . '" class="btn btn-primary">Update</a>
                                                <a href="clients-delete.php?deleteid=' . $id . '" class="btn btn-danger mt-1">Delete</a>
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